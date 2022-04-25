
#include <stdio.h>
#include <arpa/inet.h>
//转换为网络/主机字节序

int main(int argc, char const *argv[])
{
    /*char ip_str[] = "192.168.3.10";
    unsigned int ip_int = 0;
    unsigned char *ip_p = NULL;*/

    unsigned char ip_int[] = {192,168,3,10};
    char ip_str[16] = "";

    //将32位无符号整形数据转换为点分十进制IP地址；
    inet_ntop(AF_INET, &ip_int, ip_str, 16);

    printf("ip_s = %s\n", ip_str);

    return 0;
}

