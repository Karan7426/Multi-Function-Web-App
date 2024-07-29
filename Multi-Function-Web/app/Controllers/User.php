<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('user_view', $data);
    }

    public function filterUsers()
    {
        if ($this->request->isAJAX()) {
            $query = $this->request->getGet('query');
            $model = new UserModel();
            
            if ($query) {
                $users = $model->like('name', $query)
                               ->orLike('email', $query)
                               ->orLike('mobile', $query)
                               ->findAll();
            } else {
                $users = $model->findAll();
            }

            $response = '';
            if (!empty($users)) {
                foreach ($users as $user) {
                    $response .= '
                    <tr>
                        <td>' . $user['id'] . '</td>
                        <td>' . $user['name'] . '</td>
                        <td>' . $user['email'] . '</td>
                        <td>' . $user['mobile'] . '</td>
                        <td><img src="/uploads/' . $user['profile_pic'] . '" width="50" height="50" class="img-thumbnail"></td>
                        <td>
                            <a href="/update/' . $user['id'] . '" class="btn btn-primary btn-sm">Edit</a>
                            <form action="/delete/' . $user['id'] . '" method="post" style="display:inline;">
                                ' . csrf_field() . '
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>';
                }
            } else {
                $response = '<tr><td colspan="6" class="text-center">No users found</td></tr>';
            }

            return $response;
        }
    }

    
    
    public function create()
{
    if ($this->request->getMethod() == 'post') {
        $model = new UserModel();
        $validation = \Config\Services::validation();
//die("sss");
        $validation->setRules([
            'name' => 'required|alpha_space',
            'email' => 'required|valid_email',
            'mobile' => 'required|numeric|exact_length[10]',
            'profile_pic' => 'uploaded[profile_pic]|is_image[profile_pic]|mime_in[profile_pic,image/jpg,image/jpeg,image/png]',
            'password' => 'required|min_length[6]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
           
           // die("Validation failed: " . print_r($validation->getErrors(), true));
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());

           // die("sss");
        }

        $file = $this->request->getFile('profile_pic');
        if ($file->isValid() && !$file->hasMoved()) {
            $profilePicName = $file->getRandomName();
            $file->move('uploads/', $profilePicName);
        } else {
             
            return redirect()->back()->withInput()->with('error', 'Failed to upload profile picture.');
        }

         
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'mobile' => $this->request->getPost('mobile'),
            'profile_pic' => $profilePicName,
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];

        
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // die('Data prepared for saving');

        $model->save($data);

        return redirect()->to('/');
    }

    return view('user_create');
}





    public function update($id)
{
    $model = new UserModel();

    if ($this->request->getMethod() === 'post' || $this->request->getMethod() === 'put') {

        //die("sss")
        $validation = \Config\Services::validation();

        $rules = [
            'name' => 'required|alpha_space',
            'email' => 'required|valid_email',
            'mobile' => 'required|numeric|exact_length[10]',
            'profile_pic' => 'is_image[profile_pic]|mime_in[profile_pic,image/jpg,image/jpeg,image/png]'
        ];

         
        if ($this->request->getPost('password')) {
            $rules['password'] = 'required|min_length[6]';
        }

        $validation->setRules($rules);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userData = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'mobile' => $this->request->getPost('mobile')
        ];

        
        if ($this->request->getPost('password')) {
            $userData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $file = $this->request->getFile('profile_pic');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $profilePicName = $file->getRandomName();
            $file->move('uploads/', $profilePicName);
            $userData['profile_pic'] = $profilePicName;
        }

        
        // echo '<pre>';
        // print_r($userData);
        // echo '</pre>';
        // die('Data prepared for update');

        if ($model->update($id, $userData)) {
            return redirect()->to('/');
        } else {
            
            return redirect()->back()->withInput()->with('error', 'Failed to update user');
        }
    } else {
        $data['user'] = $model->find($id);
        return view('user_edit', $data);
    }
}



    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        return redirect()->to('/');
    }

    public function exportCSV()
    {
        $model = new UserModel();
        $users = $model->findAll();

        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"users.csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['ID', 'Name', 'Email', 'Mobile', 'Profile Pic']);

        foreach ($users as $user) {
            fputcsv($handle, [$user['id'], $user['name'], $user['email'], $user['mobile'], $user['profile_pic']]);
        }

        fclose($handle);
        exit;
    }
}
