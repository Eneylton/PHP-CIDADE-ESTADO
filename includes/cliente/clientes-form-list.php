<?php

$resultados = '';


foreach ($clientes as $item) {

   $resultados .= '<tr>
                      <td style="display:none;">' . $item->id . '</td>
                      <td>' . $item->nome . '</td>
                      <td style="display:none">' . $item->estados_id . '</td>
                      <td style="display:none">' . $item->cidades_id . '</td>
                      <td>' . $item->estado . '</td>
                      <td>' . $item->cidade . '</td>
                  
                      <td style="text-align: center;">
                        
                      
                      <button type="submit" class="btn btn-success editbtn" > <i class="fas fa-paint-brush"></i> </button>
                      &nbsp;

                       <a href="cliente-delete.php?id=' . $item->id . '">
                       <button type="button" class="btn btn-danger"> <i class="fas fa-trash"></i></button>
                       </a>


                      </td>
                      </tr>

                      ';
}

$resultados = strlen($resultados) ? $resultados : '<tr>
                                                     <td colspan="6" class="text-center" > Nenhuma Vaga Encontrada !!!!! </td>
                                                     </tr>';


unset($_GET['status']);
unset($_GET['pagina']);
$gets = http_build_query($_GET);

//PAGINAÇÂO

$paginacao = '';
$paginas = $pagination->getPages();

foreach ($paginas as $key => $pagina) {
   $class = $pagina['atual'] ? 'btn-primary' : 'btn-secondary';
   $paginacao .= '<a href="?pagina=' . $pagina['pagina'] . '&' . $gets . '">

                  <button type="button" class="btn ' . $class . '">' . $pagina['pagina'] . '</button>
                  </a>';
}

?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card card-purple">
               <div class="card-header">

                  <form method="get">
                     <div class="row my-7">
                        <div class="col">

                           <label>Buscar por Nome</label>
                           <input type="text" class="form-control" name="buscar" value="<?= $buscar ?>">

                        </div>


                        <div class="col d-flex align-items-end">
                           <button type="submit" class="btn btn-warning" name="">
                              <i class="fas fa-search"></i>

                              Pesquisar

                           </button>

                        </div>


                     </div>

                  </form>
               </div>

               <div class="table-responsive">

                  <table class="table table-bordered table-dark table-bordered table-hover table-striped">
                     <thead>
                        <tr>
                           <td colspan="9">
                              <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modal-default"> <i class="fas fa-plus"></i> &nbsp; Nova</button>
                           </td>
                        </tr>
                        <tr>

                           <th> NOME </th>
                           <th> ESTADOS </th>
                           <th> CIDADES </th>

                           <th style="text-align: center; width:200px"> AÇÃO </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?= $resultados ?>
                     </tbody>

                  </table>

               </div>


            </div>

         </div>

      </div>

   </div>

</section>

<?= $paginacao ?>


<div class="modal fade" id="modal-default">
   <div class="modal-dialog ">
      <div class="modal-content bg-gray">
         <form action="./cliente-insert.php" method="post">

            <div class="modal-header">
               <h4 class="modal-title">Novo Cliente
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label>Nome</label>
                  <input type="text" name="nome" class="form-control" placeholder="Nome" required>
               </div>

               <div class="form-group">
                  <label>Estados</label>
                  <select class="form-control form-control-lg" name="estados_id" id="estados_cod" required>
                     <option value=""> Selecione um Estado </option>
                     <?php

                     foreach ($estados as $item) {
                        echo '<option value="' . $item->id . '">' . $item->nome . '</option>';
                     }
                     ?>
                  </select>
               </div>

               <div class="form-group">

                  <label>Cidade</label>
                  <select class="form-control form-control-lg" name="cidades" id="cidades" required>


                  </select>
               </div>

            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Salvar</button>
            </div>

         </form>

      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>

<!-- EDITAR -->

<div class="modal fade" id="editmodal">
   <div class="modal-dialog">
      <form action="./cliente-edit.php" method="get">
         <div class="modal-content bg-gray">
            <div class="modal-header">
               <h4 class="modal-title">Editar Cliente
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <input type="hidden" name="id" id="id">
               <div class="modal-body">
                  <div class="form-group">
                     <label>Nome</label>
                     <input type="text" name="nome" class="form-control" placeholder="Nome" id="nome" required>
                  </div>

                  <div class="form-group">
                  <label>Estados</label>
                     <select class="form-control form-control-lg" name="estados_id" id="estados_id" required>

                        <?php

                        foreach ($estados as $item) {
                           echo '<option value="' . $item->id . '">' . $item->nome . '</option>';
                        }
                        ?>
                     </select>
                  </div>

                  <div class="form-group">
                  <label>Cidades</label>
                     <select class="form-control form-control-lg" name="cidades_id" id="cidades_id" required>


                     </select>
                  </div>

               </div>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Salvar
               </button>
            </div>
         </div>
      </form>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>