
#include <stdio.h>

int main(void)
{
    //cgi程序第一行必须是以下这个：
    printf("content-type:text/html;charset=utf-8\n\n");
    printf("<html>\n<TITLE> CGI:hello!</TITLE>\n");
    printf("<body><center><h1> hello,哈哈哈好好好好！！CGI 不乱码了！！～ </h1></center></body>\n</html>");
    return 0;
}


//在这个文件的文件夹下用命令行  编译  ：
//  gcc test.c -o test.cgi
// printf("Content-type: text/html;charset=utf-8\n\n");  中文就不乱码了。。


/*配置
Apache：

一、首先已经安装上了apache服务器

二、编辑/etc/apache2/apache2.conf

首先配置apache对cgi的支持，加上如下配置：

LoadModule cgi_module /usr/lib/apache2/modules/mod_cgi.so



然后配置某个目录可以执行cgi程序，这里我以/var/www目录为例：

<Directory /var/www/>
        Options Indexes FollowSymLinks ExecCGI   #加上ExecCGI，使其支持cgi程序
        AllowOverride None
        Require all granted
        AddHandler cgi-script .exe .pl .cgi   #添加cgi程序将要处理的后缀名
</Directory>

————————————————
版权声明：本文为CSDN博主「远洪」的原创文章，遵循CC 4.0 BY-SA版权协议，转载请附上原文出处链接及本声明。
原文链接：https://blog.csdn.net/lyhdream/article/details/49737479/*/
