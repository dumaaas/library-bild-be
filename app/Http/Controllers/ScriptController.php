<?php

namespace App\Http\Controllers;
use App\Models\Script;
use DB;
use Illuminate\Http\Request;
use App\Services\ScriptService;

class ScriptController extends Controller
{

    private $viewFolder = 'pages/settings/scripts';

    public function prikaziEditPismo(Script $pismo) {

        $viewName = $this->viewFolder . '.editPismo';

        $viewModel = [
            'pismo'=>$pismo
        ];

        return view($viewName ,$viewModel);
    }
    public function prikaziSettingsPismo(ScriptService $scriptService) {

        $viewName = $this->viewFolder . '.settingsPismo';

        $viewModel = [
            'pisma' => $scriptService->getScripts()->paginate(7)
        ];

        return view($viewName ,$viewModel);
    }
    public function prikaziNovoPismo() {

        $viewName = $this->viewFolder . '.novoPismo';

        return view($viewName);
    }

    public function sacuvajPismo(Script $pismo,ScriptService $scriptService) {
        
        $viewName = $this->viewFolder . '.editPismo';

        $viewModel = [
            'pismo' => $pismo
        ];

        $scriptService->saveScript($pismo);

        //return back
        return back()->with('success', 'Pismo uspjesno sacuvano!');
    }

    public function izmijeniPismo(Script $pismo, ScriptService $scriptService) {

        $viewName = $this->viewFolder . '.editPismo';

        $viewModel = [
            'pismo' => $pismo
        ];

        $scriptService->editScript($pismo);

        //return back to the script
        return back()->with('success', 'Pismo uspjesno izmjenjeno!');
    }

    public function izbrisiPismo(Script $pismo) {
        Script::destroy($pismo->id);
        return back();
    }
}
