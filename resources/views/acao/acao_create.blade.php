@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/acoes/create.css">
@endsection

@section('content')
    <h1 class="text-center">Cadastrar ação</h1>
    <form class="container form" action="{{ Route('acao.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Hiddens-->
        <input type="hidden" name="usuario_id" value="{{ Auth::user()->id }}">

        <div class="form-row">
            <div class="row d-flex aligm-items-start justify-content-start">
                <div class="col-md-10 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                    <span class="tittle-input ">Título<strong style="color: red">*</strong></span>
                    <input class="w-75 input-text " type="text" name="titulo" id="" value="{{ old('titulo') }}" required>
                </div>
            </div>

            <div class="row d-flex aligm-items-start justify-content-start">
                <input hidden type="file" name="anexo" id="anexo">

                <div class="col-md-6 spacing-row1 input-create-box border-upload d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input ">Arquivo<strong style="color: red">*</strong></span>
                    <div class="w-100 d-flex align-items-center justify-content-between">
                        <input class="w-75 input-text " type="text" name="" id="arquivo" disabled value="" placeholder="Insira aqui o seu arquivo" required>
                        <label for="anexo" id="">
                            <img class="upload-icon tittle-input" src="/images/acoes/create/upload.svg" alt="">
                            <label for="anexo" id=""> </label>
                    </div>
                </div>

                <div class="col-md-2 spacing-row2 input-create-box">
                    <span class="tittle-input w-50">Início<strong style="color: red">*</strong></span><input class="w-100" type="date" name="data_inicio"
                        id="" value="{{ old('data_inicio') }}" required>
                </div>
                <div class="col-md-2 spacing-row2 input-create-box">
                    <span class="tittle-input w-50">Término<strong style="color: red">*</strong></span><input class="w-100" type="date" name="data_fim"
                        id="" value="{{ old('data_fim') }}" required>
                </div>
            </div>


            <div class="row d-flex aligm-items-start justify-content-start">
                <div class="col-md-4 spacing-row1 input-create-box border-upload d-flex align-items-start justify-content-start flex-column">
                    <span class="tittle-input w-25">Natureza<strong style="color: red">*</strong></span>
                    <select class="select-form w-100 " name="natureza_id" id="select_natureza" required>
                        <option value="" selected hidden>-- Natureza --</option>
                        @foreach ($naturezas as $natureza)
                            <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                    <span class="tittle-input w-25">Tipo<strong style="color: red">*</strong></span>

                    <input type="hidden" name="tipo_natureza_id" value="0">

                    <select name="ensino" class="select-form w-100 " id="select_tipo_natureza_ensino">
                        <option value="" selected hidden>-- Tipo Natureza --</option>
                        @foreach ($naturezas_ensino as $natureza_ensino)
                            <option value="{{ $natureza_ensino->id }}">{{ $natureza_ensino->descricao }}</option>
                        @endforeach
                    </select>

                    <select name="extensao" class="select-form w-100 " id="select_tipo_natureza_extensao">
                        <option value="" selected hidden>-- Tipo Natureza --</option>
                        @foreach ($naturezas_extensao as $natureza_extensao)
                            <option value="{{ $natureza_extensao->id }}">{{ $natureza_extensao->descricao }}</option>

                        @endforeach
                    </select>

                    <select name="pesquisa" class="select-form w-100 " id="select_tipo_natureza_pesquisa">
                        <option value="" selected hidden>-- Tipo Natureza --</option>
                        @foreach ($naturezas_pesquisa as $natureza_pesquisa)
                            <option value="{{ $natureza_pesquisa->id }}">{{ $natureza_pesquisa->descricao }}</option>

                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row d-flex aligm-items-start justify-content-start">
                <div class="col-md-6 input-create-box d-flex aligm-items-start justify-content-start flex-column">
                    <span class="tittle-input ">Unidade Administrativa<strong style="color: red">*</strong></span>
                    <select class="select-form w-100 " name="unidade_administrativa_id" id="" required>
                        @foreach ($unidades_adm as $unidade_adm)
                            <option value="">-- Unidade Administrativa --</option>
                            <option value="{{ $unidade_adm->id }}">{{ $unidade_adm->descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row d-flex justify-content-start align-items-center">
                <div class="col d-flex justify-content-evenly align-items-center input-create-box border-0">
                    <a class="d-flex justify-content-center align-items-center cancel" href={{ route('home') }}>Cancelar</a>
                    <button class="submit" type="submit">Cadastrar</button>
                </div>
            </div>

    </form>

    <script>
        var campoanexo = document.getElementById('anexo');
        var campoArquivo = document.getElementById('arquivo');

        $("#select_tipo_natureza_ensino").hide();
        $("#select_tipo_natureza_extensao").hide();
        $("#select_tipo_natureza_pesquisa").hide();

        campoanexo.addEventListener('change',(e)=>{

           var string = e.target.value

           var dados = string.split(/[\\"]/g)

           campoArquivo.value = dados[dados.length - 1]

        })

        $("#select_natureza").change(function ()
        {
            if($("#select_natureza").val() == 1)
            {
                $("#select_tipo_natureza_ensino").show();
                $("#select_tipo_natureza_extensao").hide();
                $("#select_tipo_natureza_pesquisa").hide();
            } else if($("#select_natureza").val() == 2)
            {
                $("#select_tipo_natureza_ensino").hide();
                $("#select_tipo_natureza_extensao").show();
                $("#select_tipo_natureza_pesquisa").hide();
            } else if($("#select_natureza").val() == 3)
            {
                $("#select_tipo_natureza_ensino").hide();
                $("#select_tipo_natureza_extensao").hide();
                $("#select_tipo_natureza_pesquisa").show();
            }
        });
    </script>

@endsection








