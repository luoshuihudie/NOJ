<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Compiler;
use App\Http\Controllers\Controller;

class ProblemController extends Controller
{
    /**
     * Show the Problem Detail Page.
     *
     * @return Response
     */
    public function detail($pcode)
    {
        $problem=new Problem();
        $prob_detail=$problem->detail($pcode);
        return is_null($prob_detail) ?  redirect("/problem") :
                                        view('problem.detail', [
                                            'page_title'=>$prob_detail["title"],
                                            'site_title'=>"CodeMaster",
                                            'detail' => $prob_detail
                                        ]);
    }

    /**
     * Show the Problem Editor Page.
     *
     * @return Response
     */
    public function editor($pcode)
    {
        $problem=new Problem();
        $compiler=new Compiler();
        $prob_detail=$problem->detail($pcode);
        $compiler_list=$compiler->list($prob_detail["OJ"]);
        return is_null($prob_detail) ?  redirect("/problem") :
                                        view('problem.editor', [
                                            'page_title'=>$prob_detail["title"],
                                            'site_title'=>"CodeMaster",
                                            'detail' => $prob_detail,
                                            'compiler_list' => $compiler_list
                                        ]);
    }
}
