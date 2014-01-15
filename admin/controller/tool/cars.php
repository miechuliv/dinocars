<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Robert
 * Date: 19.06.13
 * Time: 09:41
 * To change this template use File | Settings | File Templates.
 */

class ControllerToolCars extends Controller{

    public function getAllMakes()
    {
        $this->load->model('tool/cars');

        $res = $this->model_tool_cars->getAllMake();

        $data =array();

        foreach($res->rows as $row)
        {
            $data[] = array(
                'make_id' => $row['make_id'],
                'make_name' => $row['make_name']
            );
        }

        $json['output']= $data;

        $this->response->setOutput(json_encode($json));
    }

      public function getModelsAjax(){

          $make_id = (int)$this->request->post['make_id'];

          $this->load->model('tool/cars');

            $data = $this->model_tool_cars->getModelbyMake($make_id);

            $json['output']=$data;



            $this->response->setOutput(json_encode($json));
      }

    public function getTypesAjax(){

        $model_id = (int)$this->request->post['model_id'];

        $this->load->model('tool/cars');

        $data = $this->model_tool_cars->getTypebyModel($model_id);

        $json['output']=$data;


        $this->response->setOutput(json_encode($json));
    }

}