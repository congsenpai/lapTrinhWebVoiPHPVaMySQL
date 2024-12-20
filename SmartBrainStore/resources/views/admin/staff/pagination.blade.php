@foreach ($staffs as $staff)
    <tr>
        <td> <a href="#">{{ $loop->iteration }}</a></td>
        <td> <a href="#">{{ $staff->name }}</a></td>
        <td> <a href="#">{{ $staff->email }}</a></td>
        <td> <a href="#">{{ $staff->phone }}</a></td>
        <td> <a href="#">{{ $staff->address }}</a></td>
        <td>
            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateStaffModal" id="btnShowModal" data-name="{{ $staff->name }}"
                data-email="{{ $staff->email }}" data-phone="{{ $staff->phone }}" data-password="{{ $staff->password }}" 
                data-address="{{ $staff->address }}" 
                >Xem</button>
            
            <a href="{{ route('deletestaff', ['email' => $staff->email]) }}" class="btn btn-danger btn-sm" style="float: left;width:40%;margin-top:5px;">Xóa</a>
        </td>
    </tr>
@endforeach

<div class="d-flex justify-content-center">
    {!! $staffs->links() !!}
</div>
