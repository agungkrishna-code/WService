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
            try{
                if (strcmp($MyFoto1,$MyFoto2)!=0){
                    $path="Foto/".$MyFoto1;
                    unlink($path);
                }
                $stmt=$conn->prepare('UPDATE mahasiswa SET Nama=?, Umur=?, MyFoto=? WHERE Nim=?');
                $stmt->bind_param("siss",$Nama,$Umur,$MyFoto2,$IDMhs);
                $stmt->execute();
                $stmt->close();
                $response['error']=false;
                $response['message']='success';
            }catch(Exception $e){
                $response['error']=true;
                $response['message']='Gagal';
            }

        }else{
            $response['error']=true;
            $response['message']='Data Dengan ID '.$IDMhs.' Tidak Ada';
        }
    }
?>