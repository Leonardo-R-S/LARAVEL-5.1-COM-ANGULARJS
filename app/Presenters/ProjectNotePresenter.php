<?php
/**
 * Created by PhpStorm.
 * User: LeoTJ
 * Date: 01/02/2017
 * Time: 17:17
 */

namespace CodeProject\Presenters;
use CodeProject\Transformers\ProjectNoteTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectNotePresenter extends FractalPresenter
{
    public function getTransformer(){
        return new ProjectNoteTransformer();
    }

}