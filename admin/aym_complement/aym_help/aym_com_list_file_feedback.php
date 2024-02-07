<?php 
		session_start();

		$aym_row_ext = ['jpg','png','jpeg','gif']; 

		$aym_root = $_SERVER['DOCUMENT_ROOT'].'/admin/aym_document/aym_help/'.md5($_SESSION['use_id']);
		if(count(scandir($aym_root))>2){
			// Abre un directorio conocido, y procede a leer el contenido
		   	if (is_dir($aym_root)) {
				if ($dh = opendir($aym_root)) {
				   	while (($file = readdir($dh)) !== false) {
					   	if($file!='.' && $file!='..'){ 
						   $info = new SplFileInfo($aym_root."/".$file); ?>
							<div class="aym_wrap_list_files">
								<a class="<?= in_array($info->getExtension(), $aym_row_ext) ? 'aym_open_img' : ''?>" href="<?= '../../../aym_document/aym_help'.md5($_SESSION['use_id'])?>/<?= $file?>" target="_blank" title="<?= $file?>">
									<figure>
										<?php if(in_array($info->getExtension(), $aym_row_ext)){ ?>
											<img src="<?= '../../../aym_document/aym_help'.md5($_SESSION['use_id'])?>/<?= $file?>" alt="">
										<?php }else{ ?>
											<img src="/admin/aym_image/aym_icon/aym_ico_pdf.png" alt="">
										<?php }?>
									</figure>
									<span class="aym_tit"><?= substr($file, 0, 10).'...'?></span>
									<span class="aym_siz"><?= number_format((filesize($aym_root."/".$file))/1048576, 2, '.','').' MB';?></span>
									<div>
										<span class="aym_delete">X</span>
									</div>
								</a>
							</div>
<?php 					}
				   	}
				   	closedir($dh);
			   	}
			}
		}
?>