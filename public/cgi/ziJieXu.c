
#include <stdio.h>
//判断当前系统的字节序

union un {
    int a;
    char b;
    short int e;
};

int main(int argc, char const *argv[])
{
    union un myun;
    myun.a = 0x12345678;
    int c = 0x10;
    int d = 010;

    printf("a = %#x\n", myun.a);
    printf("b = %#x\n", myun.b);
    printf("e = %#x\n", myun.e);
    printf("c = %#x\n", c );
    printf("d = %#o\n", d );
    printf("b.c = %c\n", myun.b);
    printf("a.d = %d\n", myun.a);
    printf("c.d = %d\n", c);
    printf("d.d = %d\n", d);


    if(myun.b == 0x78){
        printf("小端存储\n");
    }else{
        printf("大端存储\n");
    }

    return 0;
}

