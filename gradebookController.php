<?php
/**
 * Created by PhpStorm.
 * User: Arhey
 * Date: 09.03.2017
 * Time: 21:44
 */
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\BookStorage;
use Response;
use Log;

class BookController extends MainController
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'required|date|date_format:"d-M-Y"',
            'end_date' => 'required|date|date_format:"d-M-Y"|after:start_date'
        ]);

        $title = $request->get('title');
        $description = $request->get('description');
        $startDate = DateTime::createFromFormat('d-M-Y', $request->get('start_date'));
        $endDate = DateTime::createFromFormat('d-M-Y', $request->get('end_date'));

        $gradePeriod = new BookStorage();

        $gradePeriod->setTitle($title);
        $gradePeriod->setDescription($description);
        $gradePeriod->setStartDate($startDate);
        $gradePeriod->setEndDate($endDate);
        $gradePeriod->setStorageId($this->storage->id);

        try{
            $gradePeriod->save();
        } catch (\Exception $ex){
            Log::emergency($ex->getMessage() . PHP_EOL .
                'Stack Trace: '. PHP_EOL . $ex->getTraceAsString());
            return Response::json(trans("toasters.gradebook.unknownError"), 422);
        }

        return Response::json(trans("toasters.gradebook.create.success"), 200);
    }
};
