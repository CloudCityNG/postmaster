<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h1>
  <?php echo $message['subject']; ?>
  <small>#<?php echo $message['message_id']; ?></small>
</h1>

<p class="lead">
  List-unsubscribe: <?php echo anchor('list-unsubcribe/#', $message['list']); ?>

  <a href="<?php echo base_url('message/#'); ?>">
    <span class="pull-right label label-default"><?php echo $message['type']; ?></span>
  </a>
</p>

<p>
  Reply-to:
  <?php echo $message['reply_to_name']; ?>
  <?php if (!empty($message['reply_to_email'])) echo '('.$message['reply_to_email'].')'; ?>
</p>

<div class="well well-lg"><?php echo $message['body_text']; ?></div>

<p class="small pull-right">
  <a data-toggle="modal" data-target="#htmlModal" href="#">HTML</a>
  <a href="<?php echo base_url('message/view-html/'.$message['message_id']); ?>" target="_blank"><span class="glyphicon glyphicon-new-window"></span></a>
</p>

<!-- Modal -->
<div class="modal fade" id="htmlModal" tabindex="-1" role="dialog" aria-labelledby="htmlModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="htmlModalLabel">HTML Preview</h4>
      </div>
      <div class="modal-body">
        <div class="embed-responsive embed-responsive-4by3">
          <iframe src="data:text/html;charset=utf-8,<?php echo htmlentities($message['body_html']); ?>"></iframe>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="clearfix"></div>

<?php
// drafting - Edit, Publish
// published - Edit, Draft
// archived - info

if ($message['archived'] == '1000-01-01 00:00:00')
{
  ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Edit</h3>
    </div>
    <div class="panel-body">
      <div class="media">
        <div class="media-body">
          <p>Make changes!</p>
        </div>
        <div class="media-right">
          <a href="<?php echo base_url('message/edit/'.$message['message_id']); ?>" class="btn btn-primary">
            <div class="media-object">
              <span class="glyphicon glyphicon-edit"></span>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

  <?php
  if (is_null($message['published_tds']))
  {
    // drafting
    ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Publish</h3>
      </div>
      <div class="panel-body">
        <div class="media">
          <div class="media-body">
            <p>Send emails!</p>
          </div>
          <div class="media-right">
            <a href="<?php echo base_url('message/publish/'.$message['message_id']); ?>" class="btn btn-primary">
              <div class="media-object">
                <span class="glyphicon glyphicon-send"></span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
  else
  {
    // published
    ?>
    <div class="panel panel-warning">
      <div class="panel-heading">
        <h3 class="panel-title">Warning Zone</h3>
      </div>
      <div class="panel-body">
        <div class="media">
          <div class="media-body">
            <h5 class="media-heading">Revert</h5>
            <ul class="list-unstyled-disabled">
              <li>Unpublished messages wont accept <strong>new</strong> requests.</li>
              <li>But you can publish and use it again.</li>
              <li>If you want to make some changes to the content use <strong>Edit</strong>.</li>
            </ul>
          </div>
          <div class="media-right">
            <a href="<?php echo base_url('message/revert/'.$message['message_id']); ?>" class="btn btn-warning">
              <div class="media-object">
                <span class="glyphicon glyphicon-ban-circle"></span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
}
else
{
  ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Archive</h3>
    </div>
    <div class="panel-body">
      
      <div class="media">

        <div class="media-body">
          <p>
            The message has been archived.
            <abbr title="<?php
              // Tuesday 8:53 AM, Jan 26 2016
              echo date('l g:i A, M j Y', strtotime($message['archived']));
              ?>">
              @todo: x days ago
            </abbr>
          </p>
        </div>
         <div class="media-right">
          <div class="media-object">
            <span class="glyphicon glyphicon-ok-circle"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>