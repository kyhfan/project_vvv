<?php
	//include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall2/config.php";
	include('class.uploader.php');

    $uploader = new Uploader();
	if ($_REQUEST['ig'] == "goods1")
	{
		$data = $uploader->upload($_FILES['files_main1'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => '../../../uploads/'.$_REQUEST['goodscode'].'/1/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			//'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
	}else if ($_REQUEST['ig'] == "goods2" ){
		$data = $uploader->upload($_FILES['files_main2'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => '../../../uploads/'.$_REQUEST['goodscode'].'/2/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			//'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
	}else if ($_REQUEST['ig'] == "goods3" ){
		$data = $uploader->upload($_FILES['files_main3'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => '../../../uploads/'.$_REQUEST['goodscode'].'/3/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			//'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
	}else if ($_REQUEST['ig'] == "goods4" ){
		$data = $uploader->upload($_FILES['files_main4'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => '../../../uploads/'.$_REQUEST['goodscode'].'/4/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			//'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
	}else if ($_REQUEST['ig'] == "goods5" ){
		$data = $uploader->upload($_FILES['files_main5'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => '../../../uploads/'.$_REQUEST['goodscode'].'/5/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			//'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
	}else if ($_REQUEST['ig'] == "goods_thumb" ){
		$data = $uploader->upload($_FILES['files2'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => '../../../uploads/'.$_REQUEST['goodscode'].'/thumb/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			//'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
	}else if ($_REQUEST['ig'] == "banner" ){
		$data = $uploader->upload($_FILES['files'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => '../../../uploads2/'.trim($_REQUEST['b_idx']).'/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			//'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
	}else if ($_REQUEST['ig'] == "event" ){
		$data = $uploader->upload($_FILES['files'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => '../../../uploads3/'.$_REQUEST['idx'].'/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => nu ll, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			//'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
	}else if ($_REQUEST['ig'] == "post" ){
		$data = $uploader->upload($_FILES['files'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => '../../../uploads4/'.$_REQUEST['idx'].'/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			//'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
	}else if ($_REQUEST['ig'] == "category" ){
		$data = $uploader->upload($_FILES['files'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => '../../../uploads5/'.$_REQUEST['cate_1'].'_'.$_REQUEST['cate_2'].'_'.$_REQUEST['cate_3'].'/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			//'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
	}else if ($_REQUEST['ig'] == "coupon" ){
		$data = $uploader->upload($_FILES['files'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => '../../../uploads6/'.$_REQUEST['idx'].'/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			//'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
	}else if ($_REQUEST['ig'] == "special" ){
		$data = $uploader->upload($_FILES['files'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => '../../../uploads7/'.$_REQUEST['idx'].'/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			//'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
	}else if ($_REQUEST['ig'] == "promotion1" ){
		$data = $uploader->upload($_FILES['files1'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => '../../../uploads8/'.$_REQUEST['idx'].'/1/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			//'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
	}else if ($_REQUEST['ig'] == "promotion2" ){
		$data = $uploader->upload($_FILES['files2'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => '../../../uploads8/'.$_REQUEST['idx'].'/2/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			//'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
	}else if ($_REQUEST['ig'] == "promotion3" ){
		$data = $uploader->upload($_FILES['files3'], array(
			'limit' => 10, //Maximum Limit of files. {null, Number}
			'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
			'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
			'required' => false, //Minimum one file is required for upload {Boolean}
			'uploadDir' => '../../../uploads8/'.$_REQUEST['idx'].'/3/', //Upload directory {String}
			'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
			'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
			'perms' => null, //Uploaded file permisions {null, Number}
			'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
			'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
			'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
			'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
			//'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
			'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
			'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
		));
	}
    
    if($data['isComplete']){
        $files = $data['data'];
		$file_txt	= "";
		$i			= 0;
		foreach($files['files'] as $key => $val)
		{
			//$file_txt	.= "||".$val;
			$file_txt	= $val;
			$i++;
		}

		if ($_REQUEST['ig'] == "goods1" )
		{
			// 상품정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['goods_info_table']." SET goods_img_url1='".$file_txt."' WHERE goods_code='".$_REQUEST['goodscode']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}else if ($_REQUEST['ig'] == "goods2" ){
			// 상품정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['goods_info_table']." SET goods_img_url2='".$file_txt."' WHERE goods_code='".$_REQUEST['goodscode']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}else if ($_REQUEST['ig'] == "goods3" ){
			// 상품정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['goods_info_table']." SET goods_img_url3='".$file_txt."' WHERE goods_code='".$_REQUEST['goodscode']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}else if ($_REQUEST['ig'] == "goods4" ){
			// 상품정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['goods_info_table']." SET goods_img_url4='".$file_txt."' WHERE goods_code='".$_REQUEST['goodscode']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}else if ($_REQUEST['ig'] == "goods5" ){
			// 상품정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['goods_info_table']." SET goods_img_url5='".$file_txt."' WHERE goods_code='".$_REQUEST['goodscode']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}else if ($_REQUEST['ig'] == "goods_thumb" ){
			// 상품정보에 썸네일 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['goods_info_table']." SET goods_thumb_img_url='".$file_txt."' WHERE goods_code='".$_REQUEST['goodscode']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}else if ($_REQUEST['ig'] == "banner" ){
			// 배너정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['banner_info_table']." SET banner_img_url='".$file_txt."' WHERE idx='".$_REQUEST['b_idx']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}else if ($_REQUEST['ig'] == "event" ){
			// 이벤트정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['event_info_table']." SET event_img_url='".$file_txt."' WHERE idx='".$_REQUEST['idx']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}else if ($_REQUEST['ig'] == "post" ){
			// 포스트정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['post_info_table']." SET post_img_url='".$file_txt."' WHERE idx='".$_REQUEST['idx']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}else if ($_REQUEST['ig'] == "category" ){
			// 카테고리정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['category_info_table']." SET cate_img_url='".$file_txt."' WHERE cate_1='".$_REQUEST['cate_1']."' AND cate_2='".$_REQUEST['cate_2']."' AND cate_3='".$_REQUEST['cate_3']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}else if ($_REQUEST['ig'] == "coupon" ){
			// 쿠폰정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['coupon_info_table']." SET coupon_img_url='".$file_txt."' WHERE idx='".$_REQUEST['idx']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}else if ($_REQUEST['ig'] == "special" ){
			// SPECIAL정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['special_info_table']." SET special_img_url='".$file_txt."' WHERE idx='".$_REQUEST['idx']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}else if ($_REQUEST['ig'] == "promotion1" ){
			// PROMOTION정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['promotion_info_table']." SET promotion_img_url1='".$file_txt."' WHERE idx='".$_REQUEST['idx']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}else if ($_REQUEST['ig'] == "promotion2" ){
			// PROMOTION정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['promotion_info_table']." SET promotion_img_url2='".$file_txt."' WHERE idx='".$_REQUEST['idx']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}else if ($_REQUEST['ig'] == "promotion3" ){
			// PROMOTION정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['promotion_info_table']." SET promotion_img_url3='".$file_txt."' WHERE idx='".$_REQUEST['idx']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}
	}

    if($data['hasErrors']){
        $errors = $data['errors'];
        print_r($errors);
    }
    
    function onFilesRemoveCallback($removed_files){
        foreach($removed_files as $key=>$value){
            $file = '../uploads/' . $value;
            if(file_exists($file)){
                unlink($file);
            }
        }
        
        return $removed_files;
    }

	function onFilesCompleteCallback($file)
	{
		print_r($files);
	}
?>
