<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Carbon\Carbon;
use Illuminate\Http\Request;
use Serbinario\Entities\Bairro;
use Serbinario\Entities\Cliente;

use Serbinario\Entities\ColegioEleitoral;
use Serbinario\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Serbinario\Http\Requests\ClienteFormRequest;
use Yajra\DataTables\DataTables;
use Exception;

class ClienteController extends Controller
{
    private $token;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the clientes.
     *
     * @return Illuminate\View\View
     */
    public function index(){
        $bairros = Bairro::orderBy('sequencial')->pluck('name', 'id')->all();
        $clientes = Cliente::paginate(25);

        return view('cliente.index', compact('clientes', 'bairros'));
    }

    /**
     * Display a listing of the fornecedors.
     *
     * @return Illuminate\View\View
     * @throws Exception
     */
    public function grid(Request $request)
    {
        //dd($request->all());
        $this->token = csrf_token();
        #Criando a consulta
        $rows = \DB::table('clientes')
            ->leftJoin('bairros', 'bairros.id', '=', 'clientes.bairro_id')
            ->leftJoin('colegios_eleitorais', 'colegios_eleitorais.id', '=', 'clientes.colegio_eleitoral_id')
            ->select([
                'clientes.id',
                'clientes.name',
                'clientes.phone01',
                'clientes.phone02',
                'colegios_eleitorais.name as colegio_eleitoral',
                'bairros.name as bairro',
                'created_at'
            ]);


        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {
                # Filtranto por disciplina
                if ($request->has('name')) {
                    $query->where('clientes.name', 'like', "%" . $request->get('name') . "%");
                }
                if ($request->has('bairro_id')) {
                    $query->where('clientes.bairro_id', '=',  $request->get('bairro_id') );
                }


            })

            ->addColumn('action', function ($row) {
            return '<form id="' . $row->id   . '" method="POST" action="cliente/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">                              
                                <a href="cliente/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                               
                            </div>
                        </form>
                        ';
        })->make(true);
    }

    /**
     * Show the form for creating a new cliente.
     *
     * @return Illuminate\View\View
     */
    public function create(){
        $bairros = Bairro::orderBy('sequencial')->pluck('name', 'id')->all();
        //dd($bairros);
        return view('cliente.create', compact('bairros'));
    }

    /**
     * Store a new cliente in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ClienteFormRequest $request)
    {
        try {

           // $asd = new Cliente();
            //dd($asd);
//           / dd($request->all());
            $data = $this->getData($request, new Cliente());

            $cliente = Cliente::create($data);

            return redirect()->route('cliente.cliente.edit', $cliente->id)
                ->with('success_message', 'Cadastro realizado com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Show the form for editing the specified cliente.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {

        $cliente = Cliente::with('bairro')->findOrFail($id);
        $bairros = Bairro::orderBy('sequencial')->pluck('name', 'id')->all();
        $colegiosEleitorais = ColegioEleitoral::orderBy('sequencial')->pluck('name', 'id')->all();

        return view('cliente.edit', compact('cliente', 'bairros', 'colegiosEleitorais'));
    }

    /**
     * Update the specified cliente in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ClienteFormRequest $request)
    {

        try {
            //dd(Cliente::getTableColumns());
            //dd($request->all());
            //$this->affirm($request);
;
            $cliente = Cliente::findOrFail($id);
            $data = $this->getData($request, $cliente);
            //$data['user_id'] = \Auth::id();
            //dd($data);
            $cliente->update($data);

            return redirect()->route('cliente.cliente.edit', $cliente->id)
                ->with('success_message', 'Cadastro atualizado com sucesso!');

        } catch (Exception $e) {
            dd($e);
            return back()->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified cliente from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();

            return redirect()->route('cliente.cliente.index')
                ->with('success_message', 'Cliente was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Validate the given request with the defined rules.
     *
     * @param  Illuminate\Http\Request  $request
     *
     * @return boolean
     */
    protected function affirm(Request $request)
    {
        $rules = [
            'name' => 'nullable|string|min:0|max:255',
            'celular' => 'nullable|string|min:0|max:20',
            'email' => 'nullable|string|min:0|max:100',
            'cpf_cnpj' => 'required',
            'nome_empresa' => 'nullable|string|min:0|max:255',
            'cep' => 'nullable|string|min:0|max:10',
            'numero' => 'nullable|string|min:0|max:10',
            'endereco' => 'nullable|string|min:0|max:200',
            'complemento' => 'nullable|string|min:0|max:200',
            'estado' => 'nullable|string|min:0|max:2',
            'is_whatsapp' => 'nullable|boolean',
            'obs' => 'nullable',

        ];

        return $this->validate($request, $rules);
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request, $entitie)
    {
        //dd($entitie->getTableColumns());
        $data = $request->only(
            $entitie->getTableColumns()
        );
        $data['is_whatsapp'] = $request->has('is_whatsapp');

        return $data;
    }

}
