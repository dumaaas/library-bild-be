<?php

namespace App\Http\Controllers;

use App\Models\Binding;
use DB;
use Illuminate\Http\Request;
use App\Services\BindingService;

class BindingController extends Controller
{

    private $viewFolder = 'pages/settings/bindings';

    public function prikaziEditPovez(Binding $povez) {

        $viewName = $this->viewFolder . '.editPovez';

        $viewModel = [
            'povez'=>$povez
        ];

        return view($viewName, $viewModel);
    }

    public function prikaziNoviPovez() {

        $viewName = $this->viewFolder . '.noviPovez';

        return view($viewName);
    }

    public function prikaziSettingsPovez(BindingService $bindingService) {

        $viewName = $this->viewFolder . '.settingsPovez';

        $viewModel = [
            'povezi'=>$bindingService->getBindings()->paginate(7)
        ];

        return view($viewName, $viewModel);
    }

    public function sacuvajPovez(Binding $povez,BindingService $bindingService) {
        
        $viewName = $this->viewFolder . '.editPovez';

        $viewModel = [
            'povez' => $povez
        ];

        $bindingService->saveBinding($povez);

        //return back
        return back()->with('success', 'Povez uspjesno sacuvan!');
    }

    public function izmijeniPovez(Binding $povez,BindingService $bindingService) {
   
        $viewName = $this->viewFolder . '.editPovez';

        $viewModel = [
            'povez' => $povez
        ];

        $bindingService->editBinding($povez);

        //return back to the binding
        return back()->with('success', 'Povez uspjesno izmjenjen!');
    }

    public function izbrisiPovez(Binding $povez) {
        Binding::destroy($povez->id);
        return back();
    }
}
