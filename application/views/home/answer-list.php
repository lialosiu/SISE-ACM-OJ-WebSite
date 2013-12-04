<?php
/**
 * @var AnswerList $thatAnswerList
 * @var User       $CurrentUser
 * @var Answer     $thisAnswer
 */
?>
<div id="content">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="form-inline" style="float: right">
                <div class="form-group">
                    <label>
                        <select class="form-control" onchange="location.href=$(this).val()">
                            <option value="<?php echo base_url('home/listAnswer'); ?>" <?php if (!isset($SelectingStatusCode)) echo 'selected' ?>>
                                全部
                            </option>
                            <option value="<?php echo base_url('home/listAnswerByStatusCode/-1'); ?>" <?php if (isset($SelectingStatusCode) && $SelectingStatusCode == -1) echo 'selected' ?>>
                                System Error
                            </option>
                            <option value="<?php echo base_url('home/listAnswerByStatusCode/0'); ?>" <?php if (isset($SelectingStatusCode) && $SelectingStatusCode == 0) echo 'selected' ?>>
                                Unknown Status
                            </option>
                            <option value="<?php echo base_url('home/listAnswerByStatusCode/1'); ?>" <?php if (isset($SelectingStatusCode) && $SelectingStatusCode == 1) echo 'selected' ?>>
                                Pending
                            </option>
                            <option value="<?php echo base_url('home/listAnswerByStatusCode/2'); ?>" <?php if (isset($SelectingStatusCode) && $SelectingStatusCode == 2) echo 'selected' ?>>
                                Compiling
                            </option>
                            <option value="<?php echo base_url('home/listAnswerByStatusCode/3'); ?>" <?php if (isset($SelectingStatusCode) && $SelectingStatusCode == 3) echo 'selected' ?>>
                                Running
                            </option>
                            <option value="<?php echo base_url('home/listAnswerByStatusCode/4'); ?>" <?php if (isset($SelectingStatusCode) && $SelectingStatusCode == 4) echo 'selected' ?>>
                                Accepted
                            </option>
                            <option value="<?php echo base_url('home/listAnswerByStatusCode/5'); ?>" <?php if (isset($SelectingStatusCode) && $SelectingStatusCode == 5) echo 'selected' ?>>
                                Presentation Error
                            </option>
                            <option value="<?php echo base_url('home/listAnswerByStatusCode/6'); ?>" <?php if (isset($SelectingStatusCode) && $SelectingStatusCode == 6) echo 'selected' ?>>
                                Wrong Answer
                            </option>
                            <option value="<?php echo base_url('home/listAnswerByStatusCode/7'); ?>" <?php if (isset($SelectingStatusCode) && $SelectingStatusCode == 7) echo 'selected' ?>>
                                Time Limit Exceeded
                            </option>
                            <option value="<?php echo base_url('home/listAnswerByStatusCode/8'); ?>" <?php if (isset($SelectingStatusCode) && $SelectingStatusCode == 8) echo 'selected' ?>>
                                Memory Limit Exceeded
                            </option>
                            <option value="<?php echo base_url('home/listAnswerByStatusCode/9'); ?>" <?php if (isset($SelectingStatusCode) && $SelectingStatusCode == 9) echo 'selected' ?>>
                                Output Limit Exceeded
                            </option>
                            <option value="<?php echo base_url('home/listAnswerByStatusCode/10'); ?>" <?php if (isset($SelectingStatusCode) && $SelectingStatusCode == 10) echo 'selected' ?>>
                                Runtime Error
                            </option>
                            <option value="<?php echo base_url('home/listAnswerByStatusCode/11'); ?>" <?php if (isset($SelectingStatusCode) && $SelectingStatusCode == 11) echo 'selected' ?>>
                                Compile Error
                            </option>
                        </select>
                    </label>
                </div>
                <div class="form-group">
                    <?php if (isset($thatPaginationHtml)) echo $thatPaginationHtml; ?>
                </div>
            </div>
        </div>
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
        <div class="panel-footer">
            <div style="float: right">
                <?php if (isset($thatPaginationHtml)) echo $thatPaginationHtml; ?>
            </div>
        </div>
    </div>


</div>