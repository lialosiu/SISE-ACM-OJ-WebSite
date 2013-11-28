<?php
/**
 * @var User $CurrentUser
 * @var UserList $thatUserList
 * @var User $thisUser
 * @var GroupList $thatGroupList
 * @var Group $thisGroup
 */
?>
<script>
    $(document).ready(function () {
        $('table#user-list').dataTable({
            "oLanguage"      : {
                "sLengthMenu"  : "每页显示 _MENU_ 条结果",
                "sZeroRecords" : "无数据",
                "sInfo"        : "_START_ ~ _END_ (共 _TOTAL_ 条) ",
                "sInfoEmpty"   : "无数据",
                "sInfoFiltered": "(从 _MAX_ 条中过滤)",
                "sSearch"      : "搜索：",
                "oPaginate"    : {
                    "sFirst"   : "<<",
                    "sPrevious": "<",
                    "sNext"    : ">",
                    "sLast"    : ">>"
                }
            },
            "sPaginationType": "full_numbers"
        });
    });
</script>
<div id="content">
    <?php if (isset($thatGroupList) && $thatGroupList) : ?>
        <form method="get" style="width: 200px;">
            <label class="label label-primary" for="Group">分组</label>

            <select id="Group" class="form-control" name="g" onchange="this.form.submit()">
                <option value="f" <?php if (!isset($showingGroupID) || $showingGroupID == "f") echo 'selected'; ?>>无</option>
                <?php foreach ($thatGroupList->getGroupArray() as $thisGroup) : ?>
                    <option value="<?php echo $thisGroup->getID(); ?>"
                        <?php if (isset($showingGroupID) && is_numeric($showingGroupID) && $showingGroupID == $thisGroup->getID()) echo 'selected'; ?>
                        ><?php echo $thisGroup->getGroupName(); ?></option>
                <?php endforeach; ?>
            </select>
        </form>
    <?php endif; ?>
    <div>
        <div class="panel panel-default">
            <table id="user-list" class="table table-condensed">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>用户名</th>
                    <th>昵称</th>
                    <th>分组</th>
                    <th>最后登录IP</th>
                    <th>最后登录时间</th>
                    <th>最后活动IP</th>
                    <th>最后活动时间</th>
                </tr>
                </thead>
                <tbody>
                <?php if (isset ($thatUserList)) : ?>
                    <?php foreach ($thatUserList->getUserArray() as $thisUser) : ?>
                        <tr onclick="location.href='<?php echo base_url('home/showUser/' . $thisUser->getID()); ?>'">
                            <td><?php echo $thisUser->getID(); ?></td>
                            <td><?php echo $thisUser->getUsername(); ?></td>
                            <td><?php echo $thisUser->getNickname(); ?></td>
                            <td><?php echo $thisUser->getGroup()->getGroupName(); ?></td>
                            <td><?php echo $thisUser->getLastLoginIP(); ?></td>
                            <td><?php echo $thisUser->getLastLoginTime(); ?></td>
                            <td><?php echo $thisUser->getLastActivityIP(); ?></td>
                            <td><?php echo $thisUser->getLastActivityTime(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if (isset($CurrentUser) && $CurrentUser->isAdministrator()): ?>
        <div>
            <a class="btn btn-primary" href="<?php echo base_url('register'); ?>">注册新用户</a>
            <a class="btn btn-primary" href="<?php echo base_url('home/createAGroupUser'); ?>">批量创建用户</a>
            <a class="btn btn-primary" href="<?php echo base_url('home/createGroup'); ?>">新建用户组</a>
        </div>
    <?php endif; ?>
</div>