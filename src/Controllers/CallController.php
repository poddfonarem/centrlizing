<?php

namespace src\Controllers;

use src\Services\Call;

class CallController extends Controller
{
    protected Call $call;

    public function __construct()
    {
        parent::__construct();
        $this->call = new Call($this->conn);
    }

    public function addCall(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['phone'])) {

                $phone = htmlspecialchars($_POST['phone']);
                $result = $this->call->addCall($phone);

                header('Location: /#call');

                if (isset($result['success'])) {
                    $_SESSION['success'] = $result['success'];
                } else {
                    $_SESSION['error'] = $result['error'];
                }
            }
        }
    }

    public function showCalls(): array
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 20;

        return $this->call->getPaginatedCalls($page, $limit);
    }

    public function updateCallStatus(): void
    {
        $result = $this->call->updateCallStatus($_POST['update-call-status']);

        header("Location: " . $_SERVER['HTTP_REFERER']);
        if (isset($result['success'])) {
            $_SESSION['success'] = $result['success'];
        } else {
            $_SESSION['error'] = $result['error'];
        }
    }

    public function callStatus($status, $id): string
    {
        return match ($status) {
            '1' => "<i class='icon-check-circle text-green'></i> ОК",
            '2' => "<i class='icon-error text-danger'></i> Відхилено",
            default => "<form class='p-0 m-0' action='/incs/handlers/calls/update_call_status_handler.php' method='post'>
                            <label for='update-call-status' class='d-none'></label>
                            <i class='icon-warning text-yellow'></i> Очікує
                            <button class='btn p-0 text-blue' type='submit' name='update-call-status' value='$id' id='update-call-status'>
                                [Завершити]
                            </button>
                        </form>",
        };
    }
}