<?php namespace Idee\Sharp\Utils;

use Idee\Core\Upload;
use Illuminate\Database\Eloquent\Model;
use File;
use finfo;

trait UploadsUpdaterTrait {

    /**
     * Must update the upload in the database, depending on implementation.
     *
     * @param $instance
     * @param $attr
     * @param $file
     * @return mixed
     */
    function updateFileUpload($instance, $attr, $file)
    {
        $this->updateUpload($file, $instance, $attr);
    }

    /**
     * Delete the upload on the database, depending on implementation.
     *
     * @param $instance
     * @param $attr
     * @return mixed
     */
    function deleteFileUpload($instance, $attr)
    {
        $instance->$attr->delete();
    }

    /**
     * Met à jour, créé ou supprime un Upload
     *
     * @param $file string le fichier envoyé ou null
     * @param $instance Model l'entité rattaché (Createur par exemple)
     * @param $key string la key de l'upload, càd le nom de la méthode du Model et le owner_key de l'Upload.
     */
    private function updateUpload($file, $instance, $key)
    {
        // Mise à jour ou création
        $destPath = $this->getDestinationFilePath($instance);

        if(starts_with($file, ":DUPL:"))
        {
            // Cas duplication
            $file = substr($file, strlen(":DUPL:"));
            $fileName = $this->moveFile($file, $destPath, true);
        }
        else
        {
            $file = public_path("tmp/$file");
            $fileName = $this->moveFile($file, $destPath);
        }

        // Récup mime
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file("$destPath/$fileName");

        // Gestion base de données
        if($instance->$key)
        {
            // Màj
            $instance->$key->update([
                "fichier"=>$fileName,
                "typemime"=>$mime,
            ]);
        }
        else
        {
            // Création
            Upload::create([
                "fichier"=>$fileName,
                "owner_type"=>get_class($instance),
                "owner_id"=>$instance->id,
                "owner_key"=>$key,
                "typemime"=>$mime,
            ]);
        }
    }

    /**
     * @param $instance
     * @return array
     */
    private function getDestinationFilePath($instance)
    {
        // L'instance doit exister
        if (!$instance->id) $instance->save();

        $fullClassPath = get_class($instance);
        $tab = explode("\\", $fullClassPath);
        $className = end($tab);

        return storage_path("app/data/$className/" . $instance->id);
    }

    private function moveFile($file, $dest, $copy=false)
    {
        $fileName = basename($file);
        $srcFile = $file;

        if(File::exists($srcFile))
        {
            if(!File::isDirectory($dest))
            {
                File::makeDirectory($dest, 0777, true);
            }

            $k = 1;
            $baseFileName = $fileName;
            $ext = "";
            if(($pos = strrpos($fileName, '.')) !== false)
            {
                $ext = substr($fileName, $pos);
                $baseFileName = substr($fileName, 0, $pos);
            }
            while(File::exists("$dest/$fileName"))
            {
                $fileName = $baseFileName . "-" . ($k++) . $ext;
            }

            if($copy)
            {
                File::copy($srcFile, "$dest/$fileName");
            }
            else
            {
                File::move($srcFile, "$dest/$fileName");
            }

            return $fileName;
        }

        return null;
    }

}