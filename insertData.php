<?php
    if (isTheseParameterAvailable(array('IDMhs','Nama','Umur','MyFoto1','MyFoto2'))){
        $IDMhs=$_POST['IDMhs'];
        $Nama=$_POST['Nama'];
        $Umur=$_POST['Umur'];
        $MyFoto1=$_POST['MyFoto1'];
        $MyFoto2=$_POST['MyFoto2'];

        $stmt=$conn->prepare('SELECT Nim, Nama, Umur, MyFoto FROM mahasiswa WHERE Nim=?');
        $stmt->bind_param("s",$IDMhs);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0){
            $response['error']=true;
            $response['message']='Data dengan ID '. $IDMhs .' Sudah Ada';
        }else{
            try{
                $stmt=$conn->prepare('INSERT INTO mahasiswa (Nim,Nama,Umur,MyFoto) VALUES(?,?,?,?)');
                $stmt->bind_param("ssis",$IDMhs,$Nama,$Umur,$MyFoto2);
                $stmt->execute();
                $stmt->close();
                $response['error']=false;
                $response['message']='success';
            }catch(Exception $e){
                $response['error']=true;
                $response['message']='Gagal';
            }
        }
    }
?>