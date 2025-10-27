<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postModalLabel">New Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="postForm" action="{{ route('admin.posts.store') }}" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>


</div>

@push('scripts')
    <script>
        const postModal = document.getElementById('postModal');
        const postForm = document.getElementById('postForm');
        const modalTitle = document.getElementById('postModalLabel');
        const formMethod = document.getElementById('formMethod');

        const titleInput = document.getElementById('title');
        const contentInput = document.getElementById('content');
        const statusInput = document.getElementById('status');
        postModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const postId = button.getAttribute('data-post-id');

            if (postId) {
                modalTitle.textContent = 'Edit Post';
                postForm.action = button.getAttribute('data-update-url');
                formMethod.value = 'PUT';
                titleInput.value = button.getAttribute('data-post-title');
                contentInput.value = button.getAttribute('data-post-content');
                statusInput.value = button.getAttribute('data-post-status');

            } else {
                modalTitle.textContent = 'New Post';
                postForm.action = '{{ route('admin.posts.store') }}';
                formMethod.value = 'POST';
                postForm.reset();
            }
        });

        postModal.addEventListener('hidden.bs.modal', () => {
            postForm.reset();
        });
    </script>
@endpush
