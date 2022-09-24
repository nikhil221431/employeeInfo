<?php
if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
class Employee_model extends CI_Model
{

    public function registerSumbit($username, $email, $password){

        $data  = array(
                    'username'            => $username,
                    'email'               => $email,
                    'password'            => md5($password)
                );
        $queryOpt = $this->db->insert( 'user', $data );

        $result = new stdClass();

        if(!$queryOpt) {

            $result->output = "FALSE";
            $result->message = "Unable to create user. Try again.";
        }
        else {

            $result->output = "TRUE";
            $result->message = "User successfully registered";
        }

        return $result;
    }

    public function loginSumbit($email, $password){

        $this->db->where('email',$email);
        $this->db->where('password',md5($password));
   		$query = $this->db->get('user');

        $result = new stdClass();

        if($query->num_rows() > 0){

            $userInfo = $query->row();
            $newdata  = array(
                            'userid'    => $userInfo->id,
                            'username'  => $userInfo->username,
                            'useremail' => $userInfo->email
                        );
            $this->session->set_userdata( $newdata );
            
            $result->output = "TRUE";
            $result->message = "User Successfully Login";
        }
        else {

            $result->output = "False";
            $result->message = "Please Try agein";
        }

        return $result;
    }

    public function employeeinfo($name){

        if($name != "") {

            $this->db->like('name', trim($name));
        }

        // $this->db->where('created_by', $this->session->userdata('userid'));
        $this->db->where('deleted_by', null);
        $this->db->order_by("name", "asc");
        $result = $this->db->get('employee')->result();
        return $result;
    }

    public function createemployee($name, $age, $email, $dob, $address, $photo){

        $data  = array(
                    'name'        => $name,
                    'age'         => $age,
                    'email'       => $email,
                    'birth_date'  => $dob,
                    'address'     => $address,
                    'photo'       => $photo,
                    'created_by'  => $this->session->userdata('userid')
                );
        $queryOpt = $this->db->insert('employee', $data );

        $result = new stdClass();
        if(!$queryOpt) {

            $result->output = "FALSE";
            $result->message = "Error In Create Employee";
        }
        else {

            $result->output = "TRUE";
            $result->message = "Employee Successfuly created";
        }

        return $result;
    }

    public function editemployeeinfo($empId){

        $this->db->where('id', $empId);
        $result = $this->db->get('employee')->row();
        return $result;
    }

    public function editschoolsave($empId, $name, $age, $email, $dob, $address){

        $data  = array(
                        'name'        => $name,
                        'age'         => $age,
                        'email'       => $email,
                        'birth_date'  => $dob,
                        'address'     => $address,
                        'modify_by'   => $this->session->userdata('userid')
                    );

        $this->db->where('id', $empId);
        $query = $this->db->update('employee', $data);

        $result = new stdClass();
        if(!$query){

            $result->output = "FALSE";
            $result->message = "Error In Update Employee";
        }
        else{

            $result->output = "TRUE";
            $result->message = "Employee Successfuly Update";
        }

        return $result;
    }

    public function deleteEmployee($empId){

        $data = array("deleted_by" => $this->session->userdata('userid'));
        $this->db->where('id', $empId);
        $query = $this->db->update('employee', $data);
        // $query = $this->db->delete('employee');

        $result = new stdclass();

        if(!$query){

            $result->message = "Unable to delete record. Please try again.";
            $result->output  = "FALSE";
        }
        else{

            $result->message = "Record successfuly deleted";
            $result->output  = "TRUE";
        }

        return $result;
    }
}//Welcome_model end
?>