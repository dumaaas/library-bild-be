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
     * @param  Script $script
     * @return void
     */
    public function showEditScript(Script $script) {

        $viewName = $this->viewFolder . '.editScript';

        $viewModel = [
            'script'=>$script
        ];

        return view($viewName ,$viewModel);
    }

    /**
     * Prikazi sva pisma
     *
     * @param  ScriptService $scriptService
     * @return void
     */
    public function showScripts(ScriptService $scriptService) {

        $viewName = $this->viewFolder . '.scripts';

        $viewModel = [
            'scripts' => $scriptService->getScripts()->paginate(7)
        ];

        return view($viewName ,$viewModel);
    }

    /**
     * Prikazi stranicu za unos novog pisma
     *
     * @return void
     */
    public function showAddScript() {

        $viewName = $this->viewFolder . '.addScript';

        return view($viewName);
    }

    /**
     * Kreiraj i sacuvaj novo pismo
     *
     * @param  Script $script
     * @param  ScriptService $scriptService
     */
    public function saveScript(Script $script, ScriptService $scriptService) {
        
        $viewName = $this->viewFolder . '.editScript';

        $viewModel = [
            'script' => $script
        ];

        $scriptService->saveScript($script);

        //return back
        return redirect('scripts')->with('success', 'Pismo je uspješno uneseno!');
    }

    /**
     * Izmijeni podatke o pismu
     *
     * @param  Script $script
     * @param  ScriptService $scriptService
     * @return void
     */
    public function updateScript(Script $script, ScriptService $scriptService) {

        $viewName = $this->viewFolder . '.editScript';

        $viewModel = [
            'script' => $script
        ];

        $scriptService->editScript($script);

        //return back to the script
        return redirect('scripts')->with('success', 'Pismo je uspješno izmijenjeno!');
    }

    /**
     * Izbrisi pismo
     *
     * @param  Script $script
     */
    public function deleteScript(Script $script) {
        Script::destroy($script->id);
        return back()->with('success', 'Pismo je uspješno izbrisano!');
    }
}
