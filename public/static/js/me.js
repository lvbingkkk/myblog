window.onload= function () {
    var oSearch = document.getElementById('search');
    var oCity = document.getElementById('city');
    oSearch.onclick = function () {
        if (!oCity.value) {
            alert('请输入要查询的城市名称')

        }else{
            $.ajax({
                // type: 'post',
                // contentType: "application/x-www-form-urlencoded",
                //高德API接口
                url: 'http://restapi.amap.com/v3/weather/weatherInfo?key=7c6643fee0bba8be1bec268046c17e2f&city='+oCity.value,
                // data: {id: categoryid, name: 'helenzhou'},
                dataType: 'jsonp',
                success: function (data) {

                    console.log(data);
                    $("#user").html('属地:'+ data.lives[0].city);
                    $('#user').append($('<p></p>').text('天气：' + data.lives[0].weather));

                    $('#user').append($('<p></p>').text('风向：' + data.lives[0].winddirection));

                    $('#user').append($('<p></p>').text('风力：' + data.lives[0].windpower +'级'));

                    $('#user').append($('<p></p>').text('湿度：' + data.lives[0].humidity ));

                    $('#user').append('气温：' +data.lives[0].temperature);
                }
            })
        }


    };
}