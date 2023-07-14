<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ConfigProjectStatus;
use App\Http\Controllers\Controller;
use App\Models\ConfigProject;
use Illuminate\Http\Request;

class ConfigProjectController extends Controller
{
    public function index()
    {
        $configs = ConfigProject::where('status', '!=', ConfigProjectStatus::DELETED)->get();
        return view('admin.config.list', compact('configs'));
    }

    public function processCreate()
    {
        return view('admin.config.create');
    }

    public function create(Request $request)
    {
        try {
            $item = new ConfigProject();
            $email = $request->input('email');
            $phone = $request->input('phone');
            $address = $request->input('address');
            if ($request->hasFile('logo')) {
                $thumbnail = $request->file('logo');
                $thumbnailPath = $thumbnail->store('thumbnails', 'public');
                $item->logo = $thumbnailPath;
            }
            $item->email = $email;
            $item->phone = $phone;
            $item->address = $address;
            $success = $item->save();
            if ($success) {
                alert()->success('Success', 'Create success!');
                return redirect()->route('admin.configs.show');
            }
            alert()->error('Error', 'Create fail!');
            return redirect()->route('admin.configs.show');
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function detail($id)
    {
        $config = ConfigProject::find($id);
        if (!$config || $config->status == ConfigProjectStatus::DELETED) {
            return back();
        }
        return view('admin.config.detail', compact('config'));
    }

    public function update(Request $request, $id)
    {
        try {
            $config = ConfigProject::find($id);
            if (!$config || $config->status == ConfigProjectStatus::DELETED) {
                return back();
            }
            $email = $request->input('email');
            $phone = $request->input('phone');
            $address = $request->input('address');
            if ($request->hasFile('logo')) {
                $thumbnail = $request->file('logo');
                $thumbnailPath = $thumbnail->store('thumbnails', 'public');
                $config->logo = $thumbnailPath;
            }
            $config->email = $email;
            $config->phone = $phone;
            $config->address = $address;
            $success = $config->save();
            if ($success) {
                alert()->success('Success', 'Update success!');
                return redirect()->route('admin.configs.show');
            }
            alert()->error('Error', 'Update fail!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }

    public function delete($id)
    {
        try {
            $config = ConfigProject::find($id);
            if (!$config || $config->status == ConfigProjectStatus::DELETED) {
                return back();
            }
            $config->status = ConfigProjectStatus::DELETED;
            $delete = $config->save();
            if ($delete) {
                alert()->success('Success', 'Delete success!');
                return redirect()->route('admin.configs.show');
            }
            alert()->error('Error', 'Delete fail!');
            return back();
        } catch (\Exception $exception) {
            alert()->error('Error', 'Error, Please try again!');
            return back();
        }
    }
}
