
#include <stdio.h>
#include <sys/socket.h>
//宏命令需要？
#include <sys/types.h>
#include <stdlib.h>

int main(int argc, char const *argv[])
{
    //使用socket函数创建套接字
    //用于udp网络编程 的套接字
    int sockfd;
    if( (sockfd = socket(AF_INET, SOCK_DGRAM, 0)) == -1){
        perror("fail to socket!");
        exit(1);
    }

    printf("sockfd = %d\n",sockfd);

    return 0;
}

