! ������ ������� ������� ����������� ���������� �����������.	
! � �������� ������ ������������ ������ ������.
! � ������� �� ������ Second � ������ ��������� ������������ 
! ���������� ��������� ������������ ������� � �������������� ����.

	program Third
	USE IMSL
    real*8,allocatable::u(:), matr(:,:), bdi(:), eval(:) ,evec(:,:), eigfun(:,:)
    integer,allocatable::key(:)
	real*8 Li ! ����� ��������� ��������������
	real*8 Lnm2 ! ������������t ��������b
	real*8 c,x,s,f1,f2
	real*8 pi/3.14159265358979323846d0/
	real*8 h2m/0.00418029/  ! ��� (h/2pi)**2/(2*(m=1 aem)) � ��*��������**2
	real*8 hs ! ��� ��������������.
	real*8 msn  ! ����� ����������� � ���.
	character*20 fname;

	open(11, file="Initial.txt", form='formatted', status='old')
	read(11,*)fname
	open(10, file=fname, form='formatted', status='old')
	open(12, file="temp.txt", form='formatted', status='unknown')
	open(15, file="table_lev.txt", form='formatted', status='unknown')
	open(16, file="eigfun.txt", form='formatted', status='unknown')
! mn - ����� ����������� � ���.
	read(11,*)msn
	write(*,*)msn
! Li - ������ ������� ������������� ������� � ����������.
	read(11,*)Li
	write(*,*)Li
! np - �-�� �����, ������ ���� �������� �����.
	read(10,*)np
	write(*,*)np
! nm - �-�� ����������.
	nm=np-1
! nm2 - ���������� �������� �������.
	nm2=nm/2
	allocate(u(np),matr(nm2,nm2),eval(nm2),evec(nm2,nm2),bdi(nm2),key(nm2),eigfun(nm2,nm2))

	hs=Li/nm
	Lnm2=dsqrt(2./Li)
	c=pi/Li

	do k=1,np
	  read(10,*)u(k)
	enddo

! ��������� ��������. �������������� �� ������ ��������.
    do i=1,nm2
	  do m=1,nm2
	    s=0
	    do l=1,np
		  x=c*(l-1)*hs
	      f1=Lnm2*dsin(i*x)
          f2=Lnm2*dsin(m*x)
		  if(l/2*2.eq.l)then
		    j=4
		  else
		    if(l.eq.1.or.l.eq.np)then
			  j=1
			else
			  j=2
			endif
		  endif
		  s=s+j*f1*u(l)*f2
		enddo
		matr(i,m)=s*hs/3
	  enddo
	enddo
! ������������ �������
    do i=1,nm2
		matr(i,i)=matr(i,i)+(i*c)**2*h2m/msn
	enddo

!write(12,*)'========matr======='
    do i=1,8
	  do m=1,8
		if(dabs(matr(i,m)).gt.2d-5)then
		endif
	  enddo
	enddo

	call devcsf (nm2, matr, nm2, eval, evec, nm2)

    do k=1,nm2
      bdi(k)=eval(k)
      key(k)=k
    enddo
    call sort2ri(nm2,bdi,key)
    do k=1,nm2
      bdi(k)=eval(key(k))
	  do i=1,nm2
		eigfun(k,i)=evec(key(k),i)
	  enddo
    enddo

!write(12,*)'========eigenvalues======='
    write(12,*)nm2
    do i=1,nm2
	  write(12,*)bdi(i)
	  write(15,*)bdi(i)
	enddo
    do i=1,nm2
	  write(16,*)(evec(i,k),k=1,nm2)
	enddo

	deallocate(u,matr,eval,bdi,key,evec,eigfun)

	end program Third

