<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Models\EmployeeModel;

class Employee extends BaseController
{
    use ResponseTrait;
    // all users
    public function index() {
      $model = new EmployeeModel();
      $data['employees'] = $model->orderBy('id', 'DESC')->findAll();
      return $this->respond($data);
    }
    
    // create
    public function create() {
        $model = new EmployeeModel();
        $dataRequest=$this->request->getJSON();
        $data = [
            'name' => $dataRequest->name,
            'email'  => $dataRequest->email,
        ];
        $model->insert_data($data);
        $response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Employee created successfully'
          ]
      ];
      return $this->respondCreated($response);
    }
    
    // single user
    public function show($id) {
        $model = new EmployeeModel();
        $data = $model->where('id', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No employee found');
        }
    }
    // update
    public function update($id = null) {
        $model = new EmployeeModel();
        $dataRequest=$this->request->getJSON();

        $data = [
            'name' => $dataRequest->name,
            'email' => $dataRequest->email,
        ];

        $model->update($id, $data);
        
        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Employee updated successfully'
          ]
      ];
      
      return $this->respond($response);
    }
    // delete
    public function delete($id = null) {
        $model = new EmployeeModel();
        $data = $model->where('id', $id)->delete($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Employee successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No employee found');
        }
    }
}