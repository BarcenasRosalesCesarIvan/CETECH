<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Escolares\AlumnoController;
use App\Http\Controllers\EscolaresPlanEstudiosController;
use App\Http\Controllers\Escolares\DocenteController;
use App\Http\Controllers\Escolares\EdificioController;
use App\Http\Controllers\Escolares\SalonController;
use App\Http\Controllers\Escolares\EspecialidadesController;
use App\Http\Controllers\Escolares\MateriaController;
use App\Http\Controllers\Escolares\PeriodoController;
use App\Http\Controllers\Escolares\MateriaPlanEstudioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Este es el dominio raiz
/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',function () {
    return "Este es el comienzo de Laravel papi";
});

// Las rutas se ponen de arriba a abajo, el ordne de las rutas es importante
Route::get('/post/create',function () {
    return "Crea un post ";
});

Route::get('/post/{nombre}',function ($nombre) {
    return "Post $nombre";
});

Route::get('/post/{categoria}/{nombre}',function ($categoria, $nombre) {
    return "Post $nombre de la categoria $categoria";
});
*/

// Así se hace la llamada a funciones desde el controlador
// Se hace referencia a la ruta de Homre con el -> name


//Route::get('/login',[HomeController::class, 'login'] )->name('login');
//Route::get('/home',[HomeController::class, 'index'] )->name('home');



// Grupos de rutas para Escolaeres








Auth::routes();

Route::get('/', [HomeController::class, 'index']); 

//Route::get('/login',[HomeController::class, 'login'] )->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');








Route::group(['middleware' => ['role:division']], function () {
// PLANES DE ESTUDIO
Route::get('/escolares/planes_estudio', [App\Http\Controllers\EscolaresPlanEstudiosController::class, 'index'])->name('escolaresPlanEstudio');
Route::get('/escolares/Planes', [App\Http\Controllers\EscolaresPlanEstudiosController::class, 'index'])->name('escolaresPlanesEstudios');
Route::get('/plan-estudio/editar/{id}', [App\Http\Controllers\EscolaresPlanEstudiosController::class, 'updatePlanEstudio'])->name('PlanesEstudioEditar');
Route::post('/escolares/planes_estudio/create', [EscolaresPlanEstudiosController::class, 'createPlanEstudio']) ->name('PlanesEstudioCrear');
Route::delete('/plan-estudio/eliminar/{id}', [App\Http\Controllers\EscolaresPlanEstudiosController::class, 'deletePlanEstudio'])->name('PlanesEstudioEliminar');

// PARTES DE MATERIAS
Route::get('/escolares/materias', [App\Http\Controllers\Escolares\MateriaController::class, 'index'])->name('escolaresMaterias');
Route::get('/escolares/editarMaterias/{id}', [App\Http\Controllers\Escolares\MateriaController::class, 'updateMaterias'])->name('EditarMaterias');
Route::post('/escolares/materias/create', [MateriaController::class, 'createMateria']) ->name('MateriasCrear');
Route::delete('/escolares/eliminarMaterias/{id}', [App\Http\Controllers\Escolares\MateriaController::class, 'deleteMaterias'])->name('MateriasEliminar');
});

// ESCOLARES

Route::group(['middleware' => ['role:escolares']], function () {
// DOCENTE
Route::get('/escolares/Docentes', [App\Http\Controllers\Escolares\DocenteController::class, 'index'])->name('escolaresDocentes');
Route::get('/escolares/editarDocentes/{id}', [App\Http\Controllers\Escolares\DocenteController::class, 'updateDocentes'])->name('EditarDocentes');
Route::post('/escolares/Docentes/create', [DocenteController::class, 'createDocente']) ->name('DocentesCrear');
Route::delete('/escolares/eliminarDocentes/{id}', [App\Http\Controllers\Escolares\DocenteController::class, 'deleteDocente'])->name('DocenteEliminar');

// EDIFICIOS
Route::get('/escolares/edificios', [App\Http\Controllers\Escolares\EdificioController::class, 'getEdificios'])->name('escolaresEdificios');
Route::delete('/escolares/eliminarEdificios/{id}', [App\Http\Controllers\Escolares\EdificioController::class, 'deleteEdificio'])->name('EdificioEliminar');
Route::post('/escolares/Edificios/create', [EdificioController::class, 'createEdificios']) ->name('EdificiosCrear');
Route::get('/escolares/editarEdificios/{id}', [App\Http\Controllers\Escolares\EdificioController::class, 'updateEdificio'])->name('EditarEdificio');

// SALONES
Route::delete('/escolares/eliminarSalones/{id}', [App\Http\Controllers\Escolares\SalonController::class, 'deleteSalones'])->name('SalonEliminar');
Route::post('/escolares/Salones/create', [SalonController::class, 'createSalon']) ->name('SalonesCrear');
Route::get('/escolares/editarSalones/{id}', [App\Http\Controllers\Escolares\SalonController::class, 'updateSalones'])->name('EditarSalones');

// VISUALIZAR ALUMNOS
Route::get('/escolares/alumnos',[AlumnoController::class, 'index'] )->name('escolaresAlumnos');
Route::post('/escolares/alumnos/create', [AlumnoController::class, 'generarAlumno']) ->name('generarAlumno');
Route::get('/escolares/editarAlumnos/{id}', [AlumnoController::class, 'updateAlumnos'])->name('EditarAlumnos');
Route::delete('/escolares/eliminarAlumnos/{id}', [AlumnoController::class, 'deleteAlumnos'])->name('AlumnosEliminar');

// PERIODOS
Route::get('/escolares/periodos', [App\Http\Controllers\Escolares\PeriodoController::class, 'index'])->name('escolaresPeriodos');
Route::get('/escolares/editarPeriodos/{id}', [App\Http\Controllers\Escolares\PeriodoController::class, 'updatePeriodos'])->name('EditarPeriodos');
Route::post('/escolares/periodos/create', [PeriodoController::class, 'createPeriodos']) ->name('PeriodosCrear');
Route::delete('/escolares/eliminarPeriodos/{id}', [App\Http\Controllers\Escolares\PeriodoController::class, 'deletePeriodos'])->name('PeriodosEliminar');

// GRUPOS
Route::get('/escolares/grupos', [App\Http\Controllers\Escolares\GrupoController::class, 'getGrupos'])->name('escolaresGrupos');
Route::get('/escolares/editarGrupos/{id}', [App\Http\Controllers\Escolares\GrupoController::class, 'updateGrupos'])->name('EditarGrupos');
Route::delete('/escolares/eliminarGrupos/{id}', [App\Http\Controllers\Escolares\GrupoController::class, 'deleteGrupo'])->name('GruposEliminar');
Route::post('/escolares/grupos/create', [App\Http\Controllers\Escolares\GrupoController::class, 'createGrupo']) ->name('GrupoCrear');




// ================== ALUMNOS =============================================================//


});

//});




// Parte de division

Route::middleware(['division'])->group(function () {
    // PARTES DE MATERIAS-PLANES DE ESTUDIO
    // ruta para visualizar
    Route::get('/escolares/materiasPlanes', [App\Http\Controllers\Escolares\MateriaPlanEstudioController::class, 'getMateriaPlanEstudios'])->name('escolaresMateriaPlanEstudio');
    // ruta para modificar
    Route::get('/escolares/editarmateriasPlanes/{id}', [App\Http\Controllers\Escolares\MateriaPlanEstudioController::class, 'updatemateriasPlanEstudios'])->name('EditarMP');
    // ruta para crear 
    Route::post('/escolares/materiasPlanes/create', [MateriaPlanEstudioController::class, 'createmateriasPlanesEstudios']) ->name('MPCrear');
    // ruta de eliminar registros
    Route::delete('/escolares/eliminarmateriasPlanes/{id}', [App\Http\Controllers\Escolares\MateriaPlanEstudioController::class, 'deletemateriasPlanesEstudios'])->name('MPEliminar');


            // ================== ESPECIALIDADES =============================================================//
        // VISUALIZAR ESPECIALIDADES
        Route::get('/escolares/Planes2', [App\Http\Controllers\EscolaresPlanEstudiosController::class, 'index'])->name('escolaresPlanesEstudios');
        // CREAR NUEVA ESPECIALIDAD
        Route::post('/escolares/especialidad/create', [EspecialidadesController::class, 'createEspecialidades']) ->name('EspecialidadCrear');
        // ELIMINAR ESPECIALIDAD
        Route::delete('/escolares/eliminarEspecialidades/{id}', [App\Http\Controllers\Escolares\EspecialidadesController::class, 'deleteEspecialidades'])->name('EspecialidadEliminar');
        // EDITAR ESPECIALIDAD
        Route::get('/escolares/editarEspecialidad/{id}', [App\Http\Controllers\Escolares\EspecialidadesController::class, 'updateEspecialidades'])->name('EditarEspecialidades');

            
});


Route::middleware(['alumnos'])->group(function () {
// grupos alumnos

});

// VISUALIZAR MATERIAS SEGUN EL PLAN

// ruta para visualizar
Route::get('/escolares/visualizamp/{id}', [App\Http\Controllers\Escolares\MateriaPlanEstudioController::class, 'visualizaMP'])->name('visualizaMP');




// ruta para visualizar
Route::get('/escolares/gruposDocentes', [App\Http\Controllers\Escolares\GruposDocenteController::class, 'visualizaGruposDocente'])->name('gruposDocente');
Route::get('/escolares/alumnosDocentes', [App\Http\Controllers\Escolares\GruposDocenteController::class, 'visualizaAlumnos'])->name('alumnosDocente');

Route::get('/escolares/gruposPlanes', [App\Http\Controllers\EscolaresPlanEstudiosController::class, 'visualizaGrupos'])->name('gruposPlanes');

Route::get('/escolares/gruposPlanesAlumnos', [App\Http\Controllers\EscolaresPlanEstudiosController::class, 'visualizaAlumnos'])->name('alumnosGrupos');
Route::post('/escolares/gruposPlanesCrearAlumno',[App\Http\Controllers\EscolaresPlanEstudiosController::class, 'createAlumno'] )->name('escolaresAlumnosCrear');
Route::delete('/escolares/eliminarAlumnosGrupos/{id}', [App\Http\Controllers\EscolaresPlanEstudiosController::class, 'deleteAlumnos'])->name('AlumnosGruposEliminar');


Route::get('/escolares/gruposAlumnos', [App\Http\Controllers\Escolares\GrupoController::class, 'getGruposAlumnos'])->name('escolaresGruposAlumnos');


Route::get('/escolares/gruposMateriasAlumnos', [App\Http\Controllers\Escolares\GruposMateriasAlumnosController::class, 'visualizaGM'])->name('gruposMateriasAlumnos');
