<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as Writer;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Employee extends BaseController
{
    public function index()
    {
        \helper('form');

        $model = \model(EmployeeModel::class);
        $data = [
            'employees'   => $model->with('departments')->paginate(10, 'group1'),
            'pager'       => $model->pager,
            'pager'       => $model->pager,
            'currentPage' => $model->pager->getCurrentPage('group1'), // The current page number
            'totalPages'  => $model->pager->getPageCount('group1'),
        ];

        return \view('employees/index', $data);
    }

    public function upload()
    {
        \helper('form');

        if (!$this->validate('uploadRules')) {
            session()->setFlashdata('error', $this->validator->getError('file'));

            return \redirect()->to('/');
        }

        if (!isset($_FILES['file']['name'])) {
            session()->setFlashdata('error', 'Something went wrong. Please try again.');

            return \redirect()->to('/');
        }

        $reader = new Xlsx();
        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        $lists = [];

        foreach ($sheetData as $data) {
            $lists[] = [
                'name' => $data[1],
                'dob' => $data[2],
                'gender' => $data[3],
                'email' => $data[4],
                'phone_number' => $data[5],
                'hire_date' => $data[6],
                'department_id' => $data[7],
            ];
        }

        if (\count($lists) > 0) {
            $model = \model(EmployeeModel::class);
            $result = $model->bulkInsert($lists);

            if ($result) {
                session()->setFlashdata('success', 'All Entries are imported successfully.');
            } else {
                session()->setFlashdata('error', 'Something went wrong. Please try again.');
            }
        }

        return \redirect()->to('/');
    }

    public function export()
    {
        $model = \model(EmployeeModel::class);

        $result = $model->with('departments')->findAll(50);

        if (\count($result) > 0) {
            $fileName = 'employees.xlsx';
            $spreadsheet = new Spreadsheet();

            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Id');
            $sheet->setCellValue('B1', 'Name');
            $sheet->setCellValue('C1', 'DOB');
            $sheet->setCellValue('D1', 'Gender');
            $sheet->setCellValue('E1', 'Email');
            $sheet->setCellValue('F1', 'Phone Number');
            $sheet->setCellValue('G1', 'Hiring Date');
            $sheet->setCellValue('H1', 'Department');
            $rows = 2;

            foreach ($result as $val) {
                $sheet->setCellValue('A' . $rows, $val->id);
                $sheet->setCellValue('B' . $rows, $val->name);
                $sheet->setCellValue('C' . $rows, $val->dob);
                $sheet->setCellValue('D' . $rows, $val->gender);
                $sheet->setCellValue('E' . $rows, $val->email);
                $sheet->setCellValue('F' . $rows, $val->phone_number);
                $sheet->setCellValue('G' . $rows, $val->hire_date);
                $sheet->setCellValue('H' . $rows, $val->department->name);
                $rows++;
            }
            $writer = new Writer($spreadsheet);
            $writer->save($fileName);

            header("Content-Type: application/vnd.ms-excel");

            header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');

            header('Expires: 0');

            header('Cache-Control: must-revalidate');

            header('Pragma: public');

            header('Content-Length:' . filesize($fileName));

            flush();

            readfile($fileName);

            exit;
        }
    }

    public function destroy($id = null)
    {
        $model = \model(EmployeeModel::class);

        $result = $model->delete($id);

        echo json_encode(array(
            "success" => $result,
        ));
    }
}
