@extends('layouts.app')

@section('load-javascript')
<script type="text/javascript">
    let modalConfirmDelete;
    $(document).ready(function() {
        const modal = document.querySelector('#confirmDeleteModal');
        const modalBody = modal.querySelector('.modal-body');
        const modalFormDelete = modal.querySelector('.form-delete');

        modalConfirmDelete = function(id, category) {
            //Set name of category in modal body
            const question = `Do you wanna delete '${category}' category ?`;
            modalBody.textContent = question;

            //Set form action
            modalFormDelete.setAttribute('action', `/categories/${id}`);

            //Open modal
            $('#confirmDeleteModal').modal();
        }
    });
</script>
@endsection

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <div class="float-left my-2">Categories</div>
            <div class="float-right">
                <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th colspan="4">Name</th>
                </thead>
                <tbody>
                    @foreach ($listCategories as $category)
                        <tr>
                            <td colspan="3">{{  $category->name }}</td>
                            <td class="text-right">
                                <a href="{{ route('categories.edit', $category->id) }}" class="text-primary" style="cursor: pointer"><i class="fas fa-edit"></i></a>
                                <a onClick="modalConfirmDelete({{ $category->id }}, '{{ $category->name }}')" class="text-danger" style="cursor: pointer"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Delete Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form method="post" class="hide form-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
@endsection
