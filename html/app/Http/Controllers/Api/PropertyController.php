<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        // เริ่ม query สำหรับ properties ที่ for_sale และยังไม่ sold
        $query = Property::query()
            ->where('for_sale', true)
            ->where('sold', false);

        // การค้นหาโดยใช้ title และ geo (province)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhereRaw("JSON_EXTRACT(geo, '$.province') LIKE ?", ["%{$search}%"]);
            });
        }

        // การจัดเรียง (sort by price หรือ date listed)
        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            $order = $request->input('order', 'asc');

            if ($sort === 'price') {
                $query->orderBy('price', $order);
            } elseif ($sort === 'date') {
                // ใช้ created_at เป็น date listed
                $query->orderBy('created_at', $order);
            }
        }

        // Pagination (25 properties per page)
        $properties = $query->paginate(25);

        return response()->json($properties);
    }
}
