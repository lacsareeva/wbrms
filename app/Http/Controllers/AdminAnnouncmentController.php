<?php

namespace App\Http\Controllers;
use App\Models\AdminArchiveFile\AdminArchiveAnnouncement;
use App\Models\AdminAnnouncement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class AdminAnnouncmentController extends Controller
{
    public function index(Request $request): View
    {
        $announcements = AdminAnnouncement::all();
        $announcements = AdminAnnouncement::orderBy('id', 'desc')->get();
        return view('admin.announcement.announcement', compact('announcements'));
    }
  
    public function save(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'what' => ['required', 'string', 'max:255'],
            'when' => ['required', 'string', 'max:255'],
            'where' => ['required', 'string', 'max:255'],
            'otherInfo' => ['required'],
        ]);
        $data = AdminAnnouncement::create($request->only(['title', 'what', 'when', 'where', 'otherInfo']));

        if ($data) {
            session()->flash('success', 'Announcement successfully added!');
            return redirect()->route('admin.announcement.announcement');
        } else {
            session()->flash('error', 'error occured');
            return redirect()->route('admin.announcement.announcement');
        }
    }

    public function delete($id): RedirectResponse
    {
        try {
            // Find the announcement to delete
            $announcement = AdminAnnouncement::findOrFail($id);
    
            // Backup the data to another table
            $archivedAnnouncements = new AdminArchiveAnnouncement();
            $archivedAnnouncements->title = $announcement->title;
            $archivedAnnouncements->what = $announcement->what;
            $archivedAnnouncements->when = $announcement->when;
            $archivedAnnouncements->where = $announcement->where;
            $archivedAnnouncements->otherInfo = $announcement->otherInfo;
            $archivedAnnouncements->created_at = $announcement->created_at;
            $archivedAnnouncements->deleted_at = now(); // Add timestamp to indicate when it was archived
            $archivedAnnouncements->save();
    
            // Proceed to delete the original record
            if ($announcement->delete()) {
                session()->flash('success', 'Announcement deleted successfully and archived!');
            } else {
                session()->flash('error', 'An error occurred while deleting the announcement.');
            }
        } catch (ModelNotFoundException $e) {
            session()->flash('error', 'Announcement not found.');
        } catch (\Exception $e) {
            session()->flash('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    
        return redirect()->route('admin.announcement.announcement');
    }    

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'what' => 'required',
            'when' => 'required',
            'where' => 'required',
            'otherInfo' => 'required',
        ]);

        // Find the announcement and update it
        $announcement = AdminAnnouncement::findOrFail($id);
        $announcement->update($request->all());

        // Redirect back with success message
        return redirect()->route('admin.announcement.announcement')
            ->with('success', 'Announcement updated successfully!');
    }
}
