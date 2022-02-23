<?php
// 数据库访问类

class Db {

    private  $pdo = null;
    private  $field='*';
    private  $where=array();
    private  $order = '';
    private  $limit =0;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=127.0.0.1;dbname=myblog','newuser','bing6117');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // 指定表名称
    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

//    指定查询字段
    public function field($field)
    {
        $this->field =$field;
        return $this;
    }

//    指定排序条件
    public function order($order)
    {
        $this->order =$order;
        return $this;

    }

    //指定查询数量
    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    //指定where条件
    public function where($where) {

        $this->where = $where;
        return $this;
    }
    
    //返回一条数据记录
    public function item() {
        $sql= $this->_build_sql('select').'limit 1';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return isset($res[0]) ? $res[0] : false;
    }

//    返回多条数据
    public function lists()
    {
        $sql = $this->_build_sql('select');
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //查询数据总数
    public function count()
    {
        $sql = $this->_build_sql('count');
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn(0);

    }

    //分页查询
    /*
     * $page 第几页
     * $pageSize 每页显示查询的条数
     */
    public function pages($page,$pageSize=10,$path='/')
    {

        $count =$this->count();

        $this->limit =($page -1)*$pageSize .','.$pageSize;
        $data = $this->lists();
        $pages = $this->_subPages($page,$pageSize,$count,$path);
        return array('total'=>$count,'data'=>$data,'pages'=>$pages);
    }

    //生成分页html（bootstrap风格）
    /*
     * $cur_page 当前页
     * $pageSize 每页显示条数
     * $total 数据总数
     */
    private function _subPages($cur_page,$pageSize,$total,$path)
    {

        $html= '';
        $symbol ='?';
        $index =strpos($path, '?');
        if ($index !==false && $index>0) {
            $symbol ='&';
        }

        //分页数，向上取整
        $page_count = ceil($total/$pageSize);
        

        //生成首页

        //生成上页
        if ($cur_page > 1) {
            $html .="<li>
                    <a href='{$path}{$symbol}page=1' aria-label='Previous'>
                        <span aria-hidden='true'>首页</span>
                    </a>
                </li>";
            $pre_page =$cur_page-1;
            $html .="<li>
                    <a href='{$path}{$symbol}page={$pre_page}' aria-label='Previous'>
                        <span aria-hidden='true'>上一页</span>
                    </a>
                </li>";
        }

        //生成数组页
        $start =$cur_page>($page_count-5)?($page_count-5):$cur_page;
        $start = $start-2;
        $start = $start<=0?1:$start;

        $end =($cur_page+5)>$page_count?$page_count:($cur_page+5);
//处理头两页显示页数不一致问题，如果总分页大于等于5保持显示5个分页
        $end = $end<8?($page_count>=8?$end=8:$end=$page_count):$end;


        for ($i = $start; $i <= $end; $i++) {
            $html .=($i==$cur_page)?" <li class=\"active\"><a href='{$path}{$symbol}page={$i}'>{$i} </a></li>":" <li ><a href='{$path}{$symbol}page={$i}'>{$i} </a></li>";
        }

        //生成下一页
        if ($cur_page <$page_count) {

            $next_page =$cur_page+1;

            $html .="<li>
                    <a href='{$path}{$symbol}page={$next_page}' aria-label='Previous'>
                        <span aria-hidden='true'>下一页</span>
                    </a>
                </li>";
            $html .="<li>
                    <a href='{$path}{$symbol}page={$page_count}' aria-label='Previous'>
                        <span aria-hidden='true'>尾页</span>
                    </a>
                </li>";
        }

        //生成尾页👆

        $html = '<nav aria-label="Page navigation"><ul class="pagination">'.$html.' </ul></nav>';

        return $html;

    }

    //添加数据
    public function insert($data)
    {
        $sql = $this->_build_sql('insert', $data);
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();
        return $this->pdo->lastInsertId();

    }

//    更新数据
    public function update($date)
    {
        $sql = $this->_build_sql('update',$date);
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    //删除数据 并返回受影响的行数
    public function delete()
    {
        $sql = $this->_build_sql('delete');
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return  $stmt->rowCount();

    }

    //构造sql语句
    private function _build_sql($type,$data=null)
    {
        $sql = '';
        //查询
        if ($type == 'select') {
            $where = $this->_build_where();

            $sql = "select {$this->field} from {$this->table} {$where} ";
            if ($this->order) {
                $sql .= "order by {$this->order} ";
            }

            if ($this->limit ) {
                $sql .= "limit {$this->limit} ";
            }


        }

//        添加
        if ($type == 'insert') {

            $sql = "insert into {$this->table}";

            $fields = $values =[];
            foreach ($data as $key => $val) {
                $fields[]= "`".$key."`";
                $values[]= is_string($val)? "'".$val."'":$val;
            }
            //用逗号','分割数组
            $sql .= "(" . implode(',', $fields) . ")values(" . implode(',', $values) . ")";

        }

        //删除
        if ($type == 'delete') {
            $where = $this->_build_where();
            $sql = "delete from article $where";
        }

        //更新
        if ($type == 'update') {
            $where = $this->_build_where();
            //生成set
            $str = '';
            foreach ( $data as $key => $val) {
                $key = "`" . $key . "`";
                $val = is_string($val)?"'".$val."'":$val;
                $str .= "{$key} = {$val},";
            }
            $str = rtrim($str, ',');
            $str = $str ? " set {$str}" : '';

            $sql = "update {$this->table} {$str} {$where}";
        }

        //总数
        if ($type == 'count') {
            $where = $this->_build_where();
            $field_list = explode(',', $this->field);
            $field = count($field_list)>1? '*':$this->field;
            $sql = "select count({$field}) from {$this->table} {$where}";

        }
//        exit($sql);
        return $sql;
    }

    //组装where条件
    public function _build_where()
    {
        $where ='';
        if (is_array($this->where)) {
            foreach ($this->where as $key => $value) {
                $value = is_string($value) ? "'".$value."'" :$value;
                $where .= "`{$key}` = {$value} and ";

            }
        }else{
            $where = $this->where;
        }
        //剔除$where 最最右边的and及空格！！！
        $where = rtrim($where, 'and ');
        $where = $where == '' ? '' : "where {$where}";

        return $where;

    }

}