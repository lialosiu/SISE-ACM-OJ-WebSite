<?php
/**
 * @var AnswerList $thatAnswerList
 * @var User $CurrentUser
 * @var Answer $thisAnswer
 */
?>
<script>
    $(document).ready(function () {
        $('table#answer-list').dataTable();
    });
</script>
<div id="content">
    <div class="panel panel-default">
        <table id="answer-list" class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>问题ID</th>
                <th>用户昵称</th>
                <th>语言</th>
                <th>耗时</th>
                <th>占用内存</th>
                <th>代码长度</th>
                <th>状态</th>
                <?php if (isset($CurrentUser) && $CurrentUser->isAdministrator()): ?>
                    <th>管理</th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php if (isset ($thatAnswerList)) : ?>
                <?php foreach ($thatAnswerList->getAnswerArray() as $thisAnswer) : ?>
                    <tr <?php if ($CurrentUser->isAdministrator() || $thisAnswer->getUserID() == $CurrentUser->getID()) echo 'onclick="location.href=\'' . base_url('home/showAnswer/' . $thisAnswer->getID()) . '\'"'; ?>>
                        <td><?php echo $thisAnswer->getID(); ?></td>
                        <td><a href="<?php echo base_url('home/showProblem/' . $thisAnswer->getProblemID()); ?>"><?php echo $thisAnswer->getProblemID(); ?></a></td>
                        <td><a href="<?php echo base_url('home/showUser/' . $thisAnswer->getUserID()); ?>"><?php echo $thisAnswer->getUser()->getNickname(); ?></a></td>
                        <td><?php echo $thisAnswer->getLanguage() ?></td>
                        <td><?php echo $thisAnswer->getUsedTime() ?></td>
                        <td><?php echo $thisAnswer->getUsedMemory(); ?></td>
                        <td><?php if ($thisAnswer->getProblem()->getContestID() != 0 && !$CurrentUser->isAdministrator()) echo '[-比赛题-]'; else echo strlen($thisAnswer->getSourceCode()); ?></td>
                        <td><?php
                            switch ($thisAnswer->getStatusCode()) {
                                case _StatusCode_Accepted:
                                    echo '<span class="text-danger">' . $thisAnswer->getStatus() . '</span>';
                                    break;
                                case _StatusCode_CompileError:
                                case _StatusCode_RuntimeError:
                                    echo '<a title="' . $thisAnswer->getInfo() . '">' . $thisAnswer->getStatus() . '</a>';
                                    break;
                                default:
                                    echo $thisAnswer->getStatus();
                                    break;
                            }
                            ?></td>
                        <?php if (isset($CurrentUser) && $CurrentUser->isAdministrator()): ?>
                            <td>
                                <a class="btn btn-primary btn-xs" href="<?php echo base_url('api/recheckAnswer/' . $thisAnswer->getID()); ?>">重判</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>