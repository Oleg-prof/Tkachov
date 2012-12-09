!��������� ��� ������� ������������� ���������

	real*8 Li ! ����� ��������� ��������������
	real*8 Lnm2 ! ������������t ��������b
	real*8 k,x,i,l,s,f1
	real*8,allocatable::evec(:,:)

	character*20 fname
	real*8 pi/3.14159265358979323846d0/
	real*8 hs ! ��� ��������������.

open(11, file="eigfun.txt", form='formatted', status='old')
open(21, file="table.txt", form='formatted', status='old')
open(10, file="upot.txt", form='formatted', status='old')
open(15, file="initial.txt", form='formatted', status='old')
read(15,*)fname
open(12, file="out data.txt", form='formatted', status='unknown')

! Li - ������ ������� ������������� ������� � ����������.
	read(15,*)Li
	write(*,*)Li
!	read(10,*)Li
!	write(*,*)Li

! np - �-�� �����, ������ ���� �������� �����.
	read(10,*)np
	write(*,*)np
!nlev - ����������� ������� ��� �������
	read(21,*)nlev
	write(*,*)nlev
! nm - �-�� ����������.
	nm=np-1
! nm2 - ���������� �������� �������.
	nm2=nm/2
	hs=Li/nm
	Lnm2=dsqrt(2./Li)
	c=pi/Li
	
	allocate(evec(nm2,nm2))
! evec - �������� ����������� �������
    do k=1,nm2
	  read(11,*)(evec(k,i),i=1,nm2)
	enddo


! ��������� ��������. �������������� �� ������ ��������.
	do k=1,nlev
		do l=1,np
	  s=0
			do i=1,nm2
	    x=c*(l-1)*hs
	    f1=Lnm2*dsin(i*x)
		s=s+f1*evec(i,k)
			enddo
write(12,*)s

		enddo
	enddo
	deallocate(evec)
end program 