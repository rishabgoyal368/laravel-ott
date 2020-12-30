<?php $__env->startSection('title','Manage Season'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-form-main-block mrg-t-40">
  <h4 class="admin-form-text"><a href="<?php echo e(url('admin/tvseries')); ?>" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons">reply</i></a> Manage Seasons <span>Of <?php echo e($tv_series->title); ?>

    <?php if($tv_series->tmdb == 'Y'): ?>
      <span class="min-info"><?php echo $tv_series->tmdb == 'Y' ? '<i class="material-icons">check_circle</i> by tmdb' : ''; ?></span>
    <?php endif; ?>
  </span></h4>
  <div class="admin-create-btn-block">
    <a id="createButton" onclick="showCreateForm()" class="btn btn-danger btn-md"><i class="material-icons left">add</i> Create Season</a>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="admin-form-block z-depth-1">
        <div id="createForm">
          <?php echo Form::open(['method' => 'POST', 'action' => 'TvSeriesController@store_seasons', 'files' => true]); ?>

            <div class="form-group<?php echo e($errors->has('season_no') ? ' has-error' : ''); ?>">
              <input type="hidden" name="tvseries" value="<?php echo e($tv_series->title); ?>">
              <?php echo Form::label('season_no', 'Season No.'); ?>

              <?php echo Form::number('season_no', null, ['class' => 'form-control', 'min' => '0']); ?>

              <small class="text-danger"><?php echo e($errors->first('season_no')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('season_slug') ? ' has-error' : ''); ?>">
              <?php echo Form::label('season_slug', 'Season Slug'); ?>

              <?php echo Form::text('season_slug', null, ['class' => 'form-control', 'min' => '0']); ?>

              <small class="text-danger"><?php echo e($errors->first('season_slug')); ?></small>
            </div>
            <div class="form-group<?php echo e($errors->has('a_language') ? ' has-error' : ''); ?>">
                <?php echo Form::label('a_language', 'Audio Languages'); ?>

                <p class="inline info"> - Please select audio language</p>
                <div class="input-group">
                  <?php echo Form::select('a_language[]', $a_lans, null, ['class' => 'form-control select2', 'multiple']); ?>

                  <a href="#" data-toggle="modal" data-target="#AddLangModal" class="input-group-addon"><i class="material-icons left">add</i></a>
                </div>
                <small class="text-danger"><?php echo e($errors->first('a_language')); ?></small>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-xs-6">
                  <?php echo Form::label('', 'Choose custom thumbnail & poster'); ?>

                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch for-custom-image">
                    <?php echo Form::checkbox('', 1, 0, ['class' => 'checkbox-switch']); ?>

                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="upload-image-main-block">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group<?php echo e($errors->has('thumbnail') ? ' has-error' : ''); ?> input-file-block">
                    <?php echo Form::label('thumbnail', 'Thumbnail'); ?> - <p class="inline info">Help block text</p>
                    <?php echo Form::file('thumbnail', ['class' => 'input-file', 'id'=>'thumbnail']); ?>

                    <label for="thumbnail" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Thumbnail">
                      <i class="icon fa fa-check"></i>
                      <span class="js-fileName">Choose a File</span>
                    </label>
                    <p class="info">Choose custom thumbnail</p>
                    <small class="text-danger"><?php echo e($errors->first('thumbnail')); ?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group<?php echo e($errors->has('poster') ? ' has-error' : ''); ?> input-file-block">
                    <?php echo Form::label('poster', 'Poster'); ?> - <p class="inline info">Help block text</p>
                    <?php echo Form::file('poster', ['class' => 'input-file', 'id'=>'poster']); ?>

                    <label for="poster" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Poster">
                      <i class="icon fa fa-check"></i>
                      <span class="js-fileName">Choose a File</span>
                    </label>
                    <p class="info">Choose custom poster</p>
                    <small class="text-danger"><?php echo e($errors->first('poster')); ?></small>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group<?php echo e($errors->has('is_protect') ? ' has-error' : ''); ?>">
              <div class="row">
                <div class="col-xs-6">
                  <?php echo Form::label('is_protect', 'Protected Video ?'); ?>

                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    <input type="checkbox" name="is_protect" class="checkbox-switch" id="is_protect">
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger"><?php echo e($errors->first('is_protect')); ?></small>
              </div>
            </div>
            <div class="search form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?> is_protect" style="display: none;">
              <?php echo Form::label('password', 'Protected Password For Video'); ?>

              <?php echo Form::password('password', null, ['class' => 'form-control','id'=>'password']); ?>

              <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
             
            </div>
             <small class="text-danger"><?php echo e($errors->first('password')); ?></small>
          
            <?php echo e(Form::hidden('tv_series_id', $id)); ?>

            <div class="switch-field">
              <div class="switch-title">Want IMDB Ratings And More Or Custom?</div>
              <input type="radio" id="switch_left" class="imdb_btn" name="tmdb" value="Y" checked/>
              <label for="switch_left">TMDB</label>
              <input type="radio" id="switch_right" class="custom_btn" name="tmdb" value="N" />
              <label for="switch_right">Custom</label>
            </div>
            <div id="custom_dtl" class="custom-dtl">
              <div class="form-group<?php echo e($errors->has('actor_id') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('actor_id', 'Actors'); ?>

                  <p class="inline info"> - Please select tvseries seasons's  actor</p>
                  <?php echo Form::select('actor_id[]', $actor_ls, null, ['class' => 'form-control select2', 'multiple']); ?>

                  <small class="text-danger"><?php echo e($errors->first('actor_id')); ?></small>
              </div>
              <div class="form-group<?php echo e($errors->has('publish_year') ? ' has-error' : ''); ?>">
                <?php echo Form::label('publish_year', 'Publish year'); ?>

                <?php echo Form::number('publish_year', null, ['class' => 'form-control', 'min' => '0']); ?>

                <small class="text-danger"><?php echo e($errors->first('publish_year')); ?></small>
              </div>
              <div class="form-group<?php echo e($errors->has('trailer_url') ? ' has-error' : ''); ?>">
                <?php echo Form::label('trailer_url', 'Trailer URL'); ?>

                <?php echo Form::text('trailer_url', null, ['class' => 'form-control','placeholder'=>'Please enter trailer url']); ?>

                <small class="text-danger"><?php echo e($errors->first('trailer_url')); ?></small>
              </div>
              <div class="form-group<?php echo e($errors->has('detail') ? ' has-error' : ''); ?>">
                <?php echo Form::label('detail', 'Description'); ?>

                <?php echo Form::text('detail', null, ['class' => 'form-control']); ?>

                <small class="text-danger"><?php echo e($errors->first('detail')); ?></small>
              </div>
            </div>
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> Reset</button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Create</button>
            </div>
            <div class="clear-both"></div>
          <?php echo Form::close(); ?>

        </div>
        <?php if(isset($seasons)): ?>
          <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $all_languages = App\AudioLanguage::all();
                // get old audio language values
                $old_lans = collect();
                $a_lans = collect();
                if ($season->a_language != null){
                  $old_list = explode(',', $season->a_language);
                  for ($i = 0; $i < count($old_list); $i++) {
                    $old1 = App\AudioLanguage::find($old_list[$i]);
                    if ( isset($old1) ) {
                      $old_lans->push($old1);
                    }
                  }
                }
                $a_lans = $all_languages->diff($old_lans);
               

            ?>
            <div id="editForm<?php echo e($season->id); ?>" class="edit-form">
              <?php echo Form::model($season, ['method' => 'PATCH', 'files' => true, 'action' => ['TvSeriesController@update_seasons', $season->id]]); ?>

               <input type="hidden" name="tvseries" value="<?php echo e($tv_series->title); ?>">
                <div class="form-group<?php echo e($errors->has('season_no') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('season_no', 'Season No.'); ?>

                  <?php echo Form::number('season_no', null, ['class' => 'form-control', 'min' => '0']); ?>

                  <small class="text-danger"><?php echo e($errors->first('season_no')); ?></small>
                </div>
                <div class="form-group<?php echo e($errors->has('season_slug') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('season_slug', 'Season Slug'); ?>

                  <?php echo Form::text('season_slug', null, ['class' => 'form-control', 'min' => '0']); ?>

                  <small class="text-danger"><?php echo e($errors->first('season_slug')); ?></small>
                </div>
                <?php echo e(Form::hidden('tv_series_id', $id)); ?>

                <div class="form-group<?php echo e($errors->has('a_language') ? ' has-error' : ''); ?>">
                  <?php echo Form::label('a_language', 'Audio Languages'); ?>

                  <div class="input-group">
                    <select name="a_language[]" id="a_language" class="form-control select2" multiple="multiple">
                      <?php if(isset($old_lans) && count($old_lans) > 0): ?>
                        <?php $__currentLoopData = $old_lans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($old->id); ?>" selected="selected"><?php echo e($old->language); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                      <?php if(isset($a_lans)): ?>
                        <?php $__currentLoopData = $a_lans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($rest->id); ?>"><?php echo e($rest->language); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </select>
                    <a href="#" data-toggle="modal" data-target="#AddLangModal" class="input-group-addon"><i class="material-icons left">add</i></a>
                  </div>
                  <small class="text-danger"><?php echo e($errors->first('a_language')); ?></small>
                </div>
               
                <div class="form-group">
                  <div class="row">
                    <div class="col-xs-6">
                      <?php echo Form::label('', 'Choose custom thumbnail & poster'); ?>

                    </div>
                    <div class="col-xs-5 pad-0">
                      <label class="switch for-custom-image">
                        <?php echo Form::checkbox('', 1, 0, ['class' => 'checkbox-switch']); ?>

                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="upload-image-main-block">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group<?php echo e($errors->has('thumbnail') ? ' has-error' : ''); ?> input-file-block">
                        <?php echo Form::label('thumbnail', 'Thumbnail'); ?> - <p class="inline info">Help block text</p>
                        <?php echo Form::file('thumbnail', ['class' => 'input-file', 'id'=>'thumbnail'.$season->id]); ?>

                        <label for="thumbnail<?php echo e($season->id); ?>" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Thumbnail">
                          <i class="icon fa fa-check"></i>
                          <span class="js-fileName">Choose a File</span>
                        </label>
                        <p class="info">Choose custom thumbnail</p>
                        <small class="text-danger"><?php echo e($errors->first('thumbnail')); ?></small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group<?php echo e($errors->has('poster') ? ' has-error' : ''); ?> input-file-block">
                        <?php echo Form::label('poster', 'Poster'); ?> - <p class="inline info">Help block text</p>
                        <?php echo Form::file('poster', ['class' => 'input-file', 'id'=>'poster'.$season->id]); ?>

                        <label for="poster<?php echo e($season->id); ?>" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Poster">
                          <i class="icon fa fa-check"></i>
                          <span class="js-fileName">Choose a File</span>
                        </label>
                        <p class="info">Choose custom poster</p>
                        <small class="text-danger"><?php echo e($errors->first('poster')); ?></small>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="form-group<?php echo e($errors->has('is_protect') ? ' has-error' : ''); ?>">
                  <div class="row">
                    <div class="col-xs-6">
                      <?php echo Form::label('is_protect', 'Protected Video ?'); ?>

                    </div>
                    <div class="col-xs-5 pad-0">
                      <label class="switch">
                        <input type="checkbox" name="is_protect" <?php echo e($season->is_protect == 1 ? 'checked' : ''); ?> class="checkbox-switch" id="is_protect">
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <small class="text-danger"><?php echo e($errors->first('is_protect')); ?></small>
                  </div>
                </div>
                <div class="search form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?> is_protect" style="<?php echo e($season->is_protect == 1 ? '' : 'display:none'); ?>">
                  <?php echo Form::label('password', 'Protected Password For Video'); ?>

                  <input type="password" id="password" name="password" value="<?php echo e($season->password); ?>" class="form-control">
                  <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  
                </div>
                <small class="text-danger"><?php echo e($errors->first('password')); ?></small>

                <div class="switch-field">
                  <div class="switch-title">Want IMDB Ratings And More Or Custom?</div>
                  <input type="radio" id="switch_left<?php echo e($season->id); ?>" class="imdb_btn" name="tmdb" value="Y" <?php echo e($season->tmdb == 'Y' ? 'checked' : ''); ?>/>
                  <label for="switch_left<?php echo e($season->id); ?>" onclick="hide_custom(<?php echo e($season->id); ?>)">TMDB</label>
                  <input type="radio" id="switch_right<?php echo e($season->id); ?>" class="custom_btn" name="tmdb" value="N" <?php echo e($season->tmdb != 'Y' ? 'checked' : ''); ?>/>
                  <label for="switch_right<?php echo e($season->id); ?>" onclick="show_custom(<?php echo e($season->id); ?>)">Custom</label>
                </div>
                <div id="custom_dtl<?php echo e($season->id); ?>" class="custom-dtl">
                  <?php
                    // get old actor list
                    $actor_ls = App\Actor::all();
                    $old_actor = collect();
                    if ($season->actor_id != null){
                      $old_list = explode(',', $season->actor_id);
                      for ($i = 0; $i < count($old_list); $i++) {
                        $old3 = App\Actor::find(trim($old_list[$i]));
                        if ( isset($old3) ) {
                          $old_actor->push($old3);
                        }
                      }
                    }
                    $old_actor = $old_actor->filter(function($value, $key) {
                      return  $value != null;
                    });
                    $actor_ls = $actor_ls->diff($old_actor);

                  ?>

                  <div class="form-group<?php echo e($errors->has('actor_id') ? ' has-error' : ''); ?>">
    									<?php echo Form::label('actor_id', 'Actors'); ?>

                      <p class="inline info"> - Please select tvseries seasons's actor</p>
                      <div class="input-group">
                        <select name="actor_id[]" id="actor_id" class="form-control select2" multiple="multiple">
                          <?php if(isset($old_actor) && count($old_actor) > 0): ?>
                            <?php $__currentLoopData = $old_actor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($old->id); ?>" selected="selected"><?php echo e($old->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>
                          <?php if(isset($actor_ls)): ?>
                            <?php $__currentLoopData = $actor_ls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($rest->id); ?>"><?php echo e($rest->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>
                        </select>
                        <a href="#" data-toggle="modal" data-target="#AddActorModal" class="input-group-addon"><i class="material-icons left">add</i></a>
                      </div>
    									<small class="text-danger"><?php echo e($errors->first('actor_id')); ?></small>
    							</div>


                  <div class="form-group<?php echo e($errors->has('publish_year') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('publish_year', 'Publish year'); ?>

                    <?php echo Form::number('publish_year', null, ['class' => 'form-control', 'min' => '0']); ?>

                    <small class="text-danger"><?php echo e($errors->first('publish_year')); ?></small>
                  </div>
                  <div class="form-group<?php echo e($errors->has('trailer_url') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('trailer_url', 'Trailer URL'); ?>

                    <?php echo Form::text('trailer_url', null, ['class' => 'form-control','placeholder'=>'Please enter trailer url']); ?>

                    <small class="text-danger"><?php echo e($errors->first('trailer_url')); ?></small>
                  </div>
                  <div class="form-group<?php echo e($errors->has('detail') ? ' has-error' : ''); ?>">
                    <?php echo Form::label('detail', 'Description'); ?>

                    <?php echo Form::text('detail', null, ['class' => 'form-control']); ?>

                    <small class="text-danger"><?php echo e($errors->first('detail')); ?></small>
                  </div>
                </div>
                <div class="btn-group pull-right">
                  <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> update season</button>
                </div>
                <div class="clear-both"></div>
              <?php echo Form::close(); ?>

            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </div>
    </div>
    <div class="col-md-6">
      <div class="admin-form-block content-block z-depth-1">
        <table class="table table-hover">
          <thead>
          <tr class="table-heading-row side-table">
            <th>#</th>
            <th>Thumbnail</th>
            <th>Season</th>
            <th>Episodes</th>
            <th>By TMDB</th>
            <th>Actions</th>
          </tr>
          </thead>
          <?php if($seasons): ?>
            <tbody>
            <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($key+1); ?></td>
                <td>
                  <?php if($season->thumbnail != null): ?>
                    <img src="<?php echo e(asset('images/tvseries/thumbnails/'.$season->thumbnail)); ?>" width="45px" class="img-responsive" alt="image">
                   
                  <?php endif; ?>
                </td>
                <td>
                  Season <?php echo e($season->season_no); ?>

                </td>
                <td>
                  <?php if(isset($season->episodes) && count($season->episodes) > 0): ?>
                    <?php echo e(count($season->episodes)); ?> episodes
                  <?php else: ?>
                    N/A
                  <?php endif; ?>
                </td>
                <td><?php echo $season->tmdb == 'Y' ? '<i class="material-icons done">done</i>' : '-'; ?></td>
                <td>
                  <div class="admin-table-action-block side-table-action">
                    <a id="editButton<?php echo e($season->id); ?>" onclick="showForms(<?php echo e($season->id); ?>)" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                    <a href="<?php echo e(route('show_episodes', $season->id)); ?>" data-toggle="tooltip" data-original-title="Manage Episodes" class="btn-success btn-floating"><i class="material-icons">settings</i></a>
                    <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#<?php echo e($season->id); ?>deleteModal"><i class="material-icons">delete</i> </button>
                  </div>
                </td>
              </tr>
              <!-- Delete Modal -->
              <div id="<?php echo e($season->id); ?>deleteModal" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">Are You Sure ?</h4>
                      <p>Do you really want to delete these records? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                      <?php echo Form::open(['method' => 'DELETE', 'action' => ['TvSeriesController@destroy_seasons', $season->id]]); ?>

                      <?php echo Form::reset("No", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']); ?>

                      <?php echo Form::submit("Yes", ['class' => 'btn btn-danger']); ?>

                      <?php echo Form::close(); ?>

                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          <?php endif; ?>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Add Actor Modal -->
<div id="AddActorModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Actor</h5>
      </div>
      <?php echo Form::open(['method' => 'POST', 'action' => 'ActorController@store', 'files' => true]); ?>

        <div class="modal-body admin-form-block">
          <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
              <?php echo Form::label('name', 'Name'); ?>

              <?php echo Form::text('name', null, ['class' => 'form-control', 'required' => 'required']); ?>

              <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
          </div>
          <div class="form-group<?php echo e($errors->has('image') ? ' has-error' : ''); ?> input-file-block">
            <?php echo Form::label('image', 'Director Image'); ?> - <p class="inline info">Help block text</p>
            <?php echo Form::file('image', ['class' => 'input-file', 'id'=>'image']); ?>

            <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Director pic">
              <i class="icon fa fa-check"></i>
              <span class="js-fileName">Choose a File</span>
            </label>
            <p class="info">Choose custom image</p>
            <small class="text-danger"><?php echo e($errors->first('image')); ?></small>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group pull-right">
            <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> Reset</button>
            <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Create</button>
          </div>
        </div>
        <div class="clear-both"></div>
      <?php echo Form::close(); ?>

    </div>
  </div>
</div>

<!-- Add Language Modal -->
<div id="AddLangModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add Language</h5>
      </div>
      <?php echo Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@store']); ?>

      <div class="modal-body">
        <div class="form-group<?php echo e($errors->has('language') ? ' has-error' : ''); ?>">
          <?php echo Form::label('language', 'Language'); ?>

          <?php echo Form::text('language', null, ['class' => 'form-control', 'required' => 'required']); ?>

          <small class="text-danger"><?php echo e($errors->first('language')); ?></small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-info">Reset</button>
          <button type="submit" class="btn btn-success">Create</button>
        </div>
      </div>
      <?php echo Form::close(); ?>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
  <script>
    $(document).ready(function(){
      $('#createForm').siblings().hide();
      $('.custom-dtl').hide();
      $('.upload-image-main-block').hide();
      $('.subtitle_list').hide();
      $('input[name="subtitle"]').click(function(){
        if($(this).prop("checked") == true){
          $('.subtitle_list').fadeIn();
        }
        else if($(this).prop("checked") == false){
          $('.subtitle_list').fadeOut();
        }
      });
    });

    $('input[name="is_protect"]').click(function(){
      if($(this).prop("checked") == true){
        $('.is_protect').fadeIn();
      }
      else if($(this).prop("checked") == false){
        $('.is_protect').fadeOut();
      }
    }); 

    $('.for-custom-image input').click(function(){
      if($(this).prop("checked") == true){
        $('.upload-image-main-block').fadeIn();
      }
      else if($(this).prop("checked") == false){
        $('.upload-image-main-block').fadeOut();
      }
    });
    let showCreateForm = () => {
      $('#createForm').show().siblings().hide();
    };
    let showForms = (id) => {
      let editForm = '#editForm' + id;
      $(editForm).show().siblings().hide();
      var custom_dtl = '#custom_dtl'+id;
      var custom_check = '#switch_right'+id;
      if ($(custom_check).is(':checked')) {
        $(custom_dtl).show();
      }
    };
    let hide_custom = (id) => {
      var custom_dtl = '#custom_dtl'+id;
      $(custom_dtl).hide();
    };
    let show_custom = (id) => {
      var custom_dtl = '#custom_dtl'+id;
      $(custom_dtl).show();
    };
  </script>
  
<script>
     $(document).ready(function() {
  var SITEURL = '<?php echo e(URL::to('')); ?>';

 
        $.ajax({
            type: "GET",
            url: SITEURL + "/admin/tvshow/upload_video/converting",
            success: function (data) {
           console.log('Success:',data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    
     });
</script>
<script type="text/javascript">
    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/admin/tvseries/seasons.blade.php ENDPATH**/ ?>