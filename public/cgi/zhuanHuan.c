
#include <stdio.h>
#include <arpa/inet.h>
//转换为网络/主机字节序

int main(int argc, char const *argv[])
{
    int a = 0x12345678;
    short int b = 0x1234;
    short int c = htons(b);
    printf("a = %#x\n", a);
    printf("a = %#x\n", ntohl(a));
    printf("a = %#x\n", a);
    printf("a = %#x\n", htonl(a));

    printf("b = %#x\n", htons(b));
    printf("b = %#x\n", ntohs(b));

    printf("c = %#x\n", htons(c));
    printf("c = %#x\n", ntohs(c));

    return 0;
}

