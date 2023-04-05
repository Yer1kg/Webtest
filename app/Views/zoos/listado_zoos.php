  <!-- ZONA DE CONTENIDO DINÁ**** TANTO SI HAY ZOOS COMO SI NO-->
  <div class="row">
      <div class="col-lg-8 mx-auto">
          <p><a href="/zoo/crear">Crear zoo</a></p>
          <!-- BUCLE SOBRE LOS ZOOS QUE NOS HAN LLEGADO DEL BACKEND -->
          <?php if (!empty($zoo) && is_array($zoo)) : ?>
              <ul class="list-group shadow">
                  <!-- PARA CADA ZOO... PINTARLO -->
                  <?php foreach ($zoo as $zoo_item) : ?>
                      <li class="list-group-item">
                          <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                              <div class="media-body order-2 order-lg-1">
                                  <h5 class="mt-0 font-weight-bold mb-2"><?= esc($zoo_item['nombre']) ?></h5>
                                  <p class="font-italic text-muted mb-0 small"><?= esc($zoo_item['ciudad']) ?></p>
                                  <a class="btn btn-primary" href="/zoo/ver/<?= esc($zoo_item['id'], 'url') ?>">Ver</a>

                                  <a class="btn btn-secondary" href="/zoo/editar/<?= esc($zoo_item['id'], 'url') ?>">Editar</a>
                                  <button type="button" zoo-id="<?= esc($zoo_item['id'], 'url') ?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmarBorrado">Borrar</button>  
                              </div>
                          </div>
                      </li>
                  <?php endforeach ?>
              </ul>
      </div>
      <!-- FIN DEL BUCLE E INICIO DEL POSIBLE "NO HAY ZOOS" -->
        <?php else : ?>
            <h3>Sin zoos</h3>
            <p>No hemos encontrado zoos.</p>
        <?php endif ?>
  </div>
  <!-- FIN DE LA TOMA DE DECISIONES-->


  <!-- Modal -->
  <div class="modal fade" id="confirmarBorrado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog">

          <div class="modal-content">

              <div class="modal-header">

                  <h1 class="modal-title fs-5" id="exampleModalLabel">Borrar un zoológico</h1>

                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

              </div>

              <div class="modal-body">

                  ¿Seguro que quiere borrar este zoológico?

              </div>

              <div class="modal-footer">

                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>

                  <button type="button" class="btn btn-primary" onclick="javascript:borradoConfirmado();">Si, estoy seguro</button>

              </div>

          </div>

      </div>

  </div>

    <script>

var idZooPulsado;

/**

 * Captura del evento de click de cualquier botón de borrado

 * Al pulsar cualquier botón, sacamos el ID que llevaba dentro

 */

document.getElementById('confirmarBorrado').addEventListener('show.bs.modal', function(e) {

    idZooPulsado = e.relatedTarget.getAttribute("zoo-id");

});



/**

 * Se ha pulsado el botón confirmar del modal y conocemos el id a borrar

 * porque está en la variable idZooPulsado

 */

function borradoConfirmado(){

    window.location.href = '/zoo/borrarzoologico/' + idZooPulsado;

}


</script>

