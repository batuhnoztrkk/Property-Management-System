



      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Hoşgeldin Öztürk Emlak Danışmanı!</h3>
                  <h6 class="font-weight-normal mb-0">Tüm Sistem Sorunsuz Çalışıyor!
                    <br><br><br><br><br><br>
                      <h4>Güncellemeler</h4>
                      <table class="table">
                          <thead>
                          <tr>
                              <th scope="col">Güncelleme Tarihi</th>
                              <th scope="col">Konu</th>
                              <th scope="col">Güncelleme İçeriği</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php
                          $item = $DB_connect->prepare('SELECT * FROM guncellemeler order by tarih DESC');
                          $item->execute();
                          $itemcount = $item->rowCount();
                          if ($itemcount){
                              $itemresult = $item->fetch(PDO::FETCH_ASSOC);
                              $newDate = date("d/m/Y H:i", strtotime($itemresult['tarih']));
                              ?>
                              <tr>
                                  <th scope="row"><?=$newDate?></th>
                                  <td><?=$itemresult['konu']?></td>
                                  <td><?=$itemresult['icerik']?></td>
                              </tr>
                              <?php
                          }
                          else{
                              ?>
                              <tr>
                                  <th scope="row">#</th>
                                  <td>#</td>
                                  <td>Yeni güncelleme bulunmamaktadır.</td>
                              </tr>
                              <?php
                          }
                          ?>

                          </tbody>
                      </table>
                </div>
                <div class="col-12 col-xl-4">

                </div>
              </div>
            </div>
          </div>
