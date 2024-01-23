<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\PersonDomain;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Domain extends Model
{
    use SoftDeletes;

    public static function getAlldomains(){

        $data =Domain::get()->all();

        $rtn = [];

        foreach($data as $d) {

            $d->count = PersonDomain::leftjoin('domains as dom', 'person_domains.domain_id', '=', 'dom.id')
            ->where('person_domains.domain_id',$d->id)
            ->count();

            $rtn[] = $d;
        }

        return $rtn;

    }

    public static function getForSelect(){
        $data = self::where('status',1)->orderBy('name','asc')->pluck('name','id');
        return $data;
    }

    public static function linkToPerson($personId, $domainId) {
        $previousDomain = PersonDomain::getCurrentByPersonId($personId);

        $addNew = false;
        if($previousDomain && $previousDomain->domain_id != $domainId) {
                $previousDomain->end_date = Carbon::now()->toDateTimeString();
                $previousDomain->is_current = 0;
                $previousDomain->deleted_by = Auth::user()->id;
                $previousDomain->save();
        }

        if(!$previousDomain || $previousDomain->domain_id != $domainId) {
            $newLink = new PersonDomain();
            $newLink->person_id = $personId;
            $newLink->domain_id = $domainId;
            $newLink->is_current = 1;
            $newLink->start_date = Carbon::now()->toDateTimeString();;
            $newLink->end_date = null;
            $newLink->created_by = Auth::user()->id;
            $newLink->save();
        }
    }
    public function updateDomainPic($picture = "domain_avatar",  $save = true) {
        $request = request();
        $dir = self::getDomainImageDir();
        $path = public_path(). '/' . $dir;

        File::isDirectory($path) or File::makeDirectory($path, 0755, true, true);

        if ($this->picture != '' && File::exists($dir . $this->picture)) {
            File::delete($dir . $this->picture);
        }

        if ($request->domain_avatar_remove == 1 && File::exists($dir . $this->picture)) {
            File::delete($dir . $this->picture);
            $this->picture = '';
        } else {
            if($request->hasFile($picture)) {
                $extension = $request->file($picture)->getClientOriginalExtension();

                $FileName = strtolower(Str::slug($this->name) . "_" . time() . '_' . rand(1000, 9999) . '.' . $extension);
                $request->file($picture)->move(self::getDomainImageDir(), $FileName);
                $this->picture = $FileName;
            }
        }

        if($save)
            $this->save();
    }

    public static function getDomainImageDir() {
        return "uploads/domains/";
    }
}
