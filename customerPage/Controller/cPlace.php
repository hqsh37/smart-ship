<?php
class CtrlPlace {
    function getProvinces() {
        include "./customerPage/Model/mPlace.php";
        $p = new ModelPlace();
        if ($result = $p->getProvinces()) {
            if($result->num_rows > 0) {
                $data = array();
                while($row = $result->fetch_assoc()) {
                    $item = array(
                        "provinceId"=>$row['province_id'],
                        "name"=>$row['name'],
                    );
    
                    $data[] = $item;
                }
    
                return $data;
            }
        } else {
            return false;   
        }
    }

    function getDistricts($provinceId) {
        include "./customerPage/Model/mPlace.php";
        $p = new ModelPlace();
        if($result = $p->getDistricts($provinceId)) {
            $data[0] = [
                'id' => null,
                'name' => 'Chọn một Quận/huyện'
            ];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = [
                    'id' => $row['district_id'],
                    'name'=> $row['name']
                ];
            }

            return $data;
        } else {
            return false;
        }
    }

    function getWards($districtId) {
        include "./customerPage/Model/mPlace.php";
        $p = new ModelPlace();
        if($result = $p->getWards($districtId)) {
            $data[0] = [
                'id' => null,
                'name' => 'Chọn một xã/phường'
            ];
        
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = [
                    'id' => $row['wards_id'],
                    'name'=> $row['name']
                ];
            }
            
            return $data;
        } else {
            return false;
        }
    }
}
?>