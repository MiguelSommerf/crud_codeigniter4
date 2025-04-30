<?php
namespace App\Controllers;
use App\Models\UserModel;

class Login extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function validarLogin()
    {
        if (!$this->validate([
            'emailuser' => 'required|valid_email',
            'senhauser' => 'required|min_length:[8]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            //redirect()->back() -> redireciona o usuário para a tela de onde ele veio.
            //withInput() -> mantém os dados digitados nos inputs do formulário, para que o usuário não precise escrever tudo novamente.
            //with('errors', $this->validator->getErrors()) -> retorna os erros para o usuário 
        }

        $user = $this->userModel->getUserByEmail($this->request->getPost('emailuser'));

        if (!empty($user)) {
            if(password_verify($user['senha_usuario'], $this->request->getPost('senhauser'))){
                session()->set('id', $user['id_usuario']);
                //session()->set() cria uma chave e armazena o valor desejado nela.
            } else {
                session()->setFlashdata('error', 'Usuário e/ou senha incorretos.');
                //session()->setFlashdata() cria uma chave e armazena o valor desejado nela, mas com a diferença que esse valor só existe na próxima requisição. Na view, é necessário utilizar o método getFlashdata() para recuperar o valor armazenado.
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Usuário e/ou senha incorretos.');
            return redirect()->back()->withInput();
        }
    }
}