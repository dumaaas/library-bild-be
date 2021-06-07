<?php

namespace App\Http\Controllers;
use App\Models\Script;
use DB;
use Illuminate\Http\Request;
use App\Services\ScriptService;

class ScriptController extends Controller
{

    private $viewFolder = 'pages/settings/scripts';

    /**
     * Prikazi stranicu za editovanje pisma
     *
     * @param  Script $pismo
     * @return void
     */
    public function prikaziEditPismo(Script $pismo) {

        $viewName = $this->viewFolder . '.editPismo';

        $viewModel = [
            'pismo'=>$pismo
        ];

        return view($viewName ,$viewModel);
    }

    /**
     * Prikazi sva pisma
     *
     * @param  ScriptService $scriptService
     * @return void
     */
    public function prikaziSettingsPismo(ScriptService $scriptService) {

        $viewName = $this->viewFolder . '.settingsPismo';

        $viewModel = [
            'pisma' => $scriptService->getScripts()->paginate(7)
        ];

        return view($viewName ,$viewModel);
    }

    /**
     * Prikazi stranicu za unos novog pisma
     *
     * @return void
     */
    public function prikaziNovoPismo() {

        $viewName = $this->viewFolder . '.novoPismo';

        return view($viewName);
    }

    /**
     * Kreiraj i sacuvaj novo pismo
     *
     * @param  Script $pismo
     * @param  ScriptService $scriptService
     */
    public function sacuvajPismo(Script $pismo, ScriptService $scriptService) {
        
        $viewName = $this->viewFolder . '.editPismo';

        $viewModel = [
            'pismo' => $pismo
        ];

        $scriptService->saveScript($pismo);

        //return back
        return redirect('settingsPismo')->with('success', 'Pismo uspjesno sacuvano!');
    }

    /**
     * Izmijeni podatke o pismu
     *
     * @param  Script $pismo
     * @param  ScriptService $scriptService
     * @return void
     */
    public function izmijeniPismo(Script $pismo, ScriptService $scriptService) {

        $viewName = $this->viewFolder . '.editPismo';

        $viewModel = [
            'pismo' => $pismo
        ];

        $scriptService->editScript($pismo);

        //return back to the script
        return redirect('settingsPismo')->with('success', 'Pismo uspjesno izmjenjeno!');
    }

    /**
     * Izbrisi pismo
     *
     * @param  Script $pismo
     */
    public function izbrisiPismo(Script $pismo) {
        Script::destroy($pismo->id);
        return back()->with('success', 'Pismo uspjesno izbrisano!');
    }
}
