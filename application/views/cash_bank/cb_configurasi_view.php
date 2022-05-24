<?php

if ($lokasi == 'HO') { //ho
  include "cb_configurasi_ho_view.php";
} else if ($lokasi == 'ESTATE') { //estate
  include "cb_configurasi_estate_view.php";
} else if ($lokasi == 'RO') { //RO
  include "cb_configurasi_ro.php";
} else if ($lokasi == 'PKS') { //PKS
  include "cb_configurasi_pks.php";
} else if ($lokasi == 'MITRA') { //MITRA
  include "CONFIG MITRA BELUM TERSEDIA";
}
