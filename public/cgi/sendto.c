#include <stdio.h>
#include <sys/socket.h>//socket
#include <netinet/in.h>//struct sockaddr_in
#include <string.h>//memset
#include <arpa/inet.h>//htons
#include <unistd.h> //close

int main(int argc, char const *argv[])
{
    //创建通信的UDP的套接字(没有port、ip)
    int sockfd = socket(AF_INET, SOCK_DGRAM, 0);
    printf("UDP套接字sockfd=%d\n", sockfd);
    //udp客户端 发送消息 给服务器
    //定义一个IPv4地址结构 存放服务器的地址信息（目的主机）
    struct sockaddr_in ser_addr;
    memset(&ser_addr, 0, sizeof(ser_addr));
    ser_addr.sin_family = AF_INET;    //IPv4
    ser_addr.sin_port = htons(8000);    //服务器的端口
    //服务器的IP地址
    inet_pton(AF_INET, "10.9.21.211", &ser_addr.sin_addr.s_addr);

    //发送数据
    sendto(sockfd, "hello net", strlen("hello net"), 0, (struct sockaddr *)&ser_addr, sizeof(ser_addr));
    //关闭套接字
    close(sockfd);
    return 0;
}