
<h2>New Post Created By A New Email</h2>

<p>A new post has been created by {{ $post->email }}.</p>

<p>Title: {{ $post->title }}</p>

<p>Description: {{ $post->description }}</p>

<p>
    <a href="{{ $approveLink }}" class="btn btn-primary">Approve Post</a>
    <a href="{{ $spamLink }}" class="btn btn-danger">Mark as Spam</a>
</p>