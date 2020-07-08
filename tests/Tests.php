<?php

namespace Tests;

/**
 * 测试接口文档
 * @package App\Http\Controllers\Test\TestController
 * @group  测试用例
*/
class Tests
{
    /**
     * 测试自动生成接口文档
     * 
     * @description 测试说明
     * @urlParam  id required 记录id.
     * @urlParam  lang 系统语言.
     * @bodyParam  user_id int required 用户id. 例如: 9
    */
    public function index(Request $request)
    {
        $routes = app()->routes->getRoutes();
        $routeList = [];
        foreach ($routes as $key => $value)
        {
            # code...
            if($value->computedMiddleware)
            {
                if (count($value->computedMiddleware)>0 && (in_array("web",$value->computedMiddleware) || in_array("api",$value->computedMiddleware)))
                {
                    $class = explode("@",$value->action["controller"]);
                    if(class_exists($class["0"]))
                    {
                        $re  = new \ReflectionClass($class["0"]);
                        $doc = $re->getDocComment ();
                        
                        $parase_result =  DocParserFactory::getInstance()->parse ( $doc );

                        
                        $methods = $re->getMethods(\ReflectionMethod::IS_PUBLIC + \ReflectionMethod::IS_PROTECTED + \ReflectionMethod::IS_PRIVATE);
                        // dd($methods);
                        
                        foreach ($methods as $method) {
                            //获取方法的注释
                            $doc = $method->getDocComment();
                            
                            //解析注释
                            $info = DocParserFactory::getInstance()->parse($doc);
                            print_r($doc);
                            // $metadata = $class_metadata +  $info;
                            // //获取方法的类型
                            // $method_flag = $method->isProtected();//还可能是public,protected类型的
                            // //获取方法的参数
                            // $params = $method->getParameters();
                            // $position=0;    //记录参数的次序
                            // foreach ($params as $param){
                            //     $arguments[$param->getName()] = $position;
                            //     //参数是否设置了默认参数，如果设置了，则获取其默认值
                            //     $defaults[$position] = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : NULL;
                            //     $position++;
                            // }
                        
                            // $call = array(
                            //     'class_name'=>$class_name,
                            //     'method_name'=>$method->getName(),
                            //     'arguments'=>$arguments,
                            //     'defaults'=>$defaults,
                            //     'metadata'=>$metadata,
                            //     'method_flag'=>$method_flag
                            // );
                            // print_r($call);
                            echo "\r\n-----------------------------------\r\n";
                        }
                    }    
                }
            }
        }
        return $routeList;
        // return ["code"=>0,"msg"=>"ok","data"=>["123","456"]];
        // $array = MoreTree::getTree(DeptInfo::all(),["first"=>"0","index"=>"uuid","pIndex"=>"pUuid","childIndex"=>"child"]);
        // $json = Formatter::make($array, Formatter::ARR);
        return ["code"=>0,"msg"=>"ok","data"=>$array];
    }
}