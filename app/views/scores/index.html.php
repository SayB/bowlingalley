<style>

.frame {
    width: 8.33%;
    border: solid 0px;
    border-right: solid 1px #333333;
    float: left;
}

.frame input {
    margin: 0px;
    padding: 2px;
    border: 0px;
}

td.first-attempt {
    width: 49%;
    border: 0px;
    border-right: solid 1px #333333;
    text-align: center;
    font-weight: bold;
}

td.second-attempt {
    width: 49%;
    border: 0px;
    border-bottom: solid 1px #333333;
    text-align: center;
    font-weight: bold;
}

.frames-container {
    border: solid 1px #333333;
}

.frame-header {
    text-align: center;
    color: #000000;
    font-weight: bold;
    border-bottom: solid 1px #333333;
}

#frame-10 {
    width: 10%;
}
#frame-10 td.second-attempt {
    width: 33%;
}
#frame-10 td.first-attempt {
    width: 33%;
}
.last-frame-attempt {
    width: 33%;
    border-bottom: solid 1px #333333;
    border-left: solid 1px #333333;
}

.frame-total {
    padding: 5px;
    text-align: center;
    font-weight: bold;
}
.score-body {
    text-align: center;
    font-weight: bold;
}
.scoretab {
    width: 16.2%;
    border-right: solid 0px;
}
.score-body {
    padding-top: 15px;
    font-size: 21px;
}
.active-frame {
    background-color: #a9dba9;
}
.tobeplayed {
    background-color: #faf2cc;
}
.played {
    background-color: #bce8f1;
}
</style>

<script type="text/javascript">

    game = {
        frames: [],
        endPoint: '/scores/save',
        currentFrame: null,
        score: null,
        init: function() {
            game.initFrames();
            game.activateFrame(1);
            console.log(game.frames);
        },
        getCurrentFrame: function() {
            return this.getFrame(this.currentFrame);
        },
        getActiveFrame: function() {
            return this.getCurrentFrame();
        },
        activateFrame: function(n) {
            game.getFrame(n).activate();

            for (var i = 0; i < n; i++) {
                var _id = '#frame-' + i;
                $(_id).removeClass('tobeplayed').removeClass('active-frame').addClass('played');
            }
        },
        getFrame: function(n) {
            return game.frames[n];
        },
        initFrames: function() {
            for (var i=1; i < 11; i++) {
                game.frames[i] = this.getNewFrame().init(i);
            }
        },
        updateFrameScores: function() {
            var grandTotal = 0;
            var framesScored = 0;

            for (var i = 1; i < 11; i++) {
                var frame = this.getFrame(i);
                if (frame.hasRolled() && frame.frameScore == null) {
                    frame.calculate();
                }
                if (frame.frameScore) {
                    grandTotal = parseInt(frame.frameScore);
                    framesScored++;
                }
            }

            console.log('Frames Score: ' + framesScored);
            $('#grand-total').html(grandTotal);
            if (framesScored == 10) {
                game.conclude();
            }
        },
        finished: 0,
        conclude: function() {
            alert('concluding game ..');
            game.score = $('#grand-total').html();
            // ^-- good place to send the final game state to the server?
            // -- more on that later I guess

            game.finished = 1;

            // now save game scores
            var postData = {};
            var frames = [];
            for (var i=1; i < 11; i++) {
                var frame = game.getFrame(i);
                frames[i] = {
                    rolls: {
                        1: frame.getRolledPins(1),
                        2: frame.getRolledPins(2)
                    },
                    score: frame.getScore()
                };
            }

            console.log('Post Data: ');
            console.log(JSON.stringify(frames));

            return;
            $.post(
                game.endPoint,
                { jsonData: JSON.stringify(frames) },
                function(response) {
                    // do something here with the response ...
                }
            )
        },
        getNewFrame: function() {
            return {
                number: null,
                totalAttempts: 2,
                currentAttempt: 1,
                frameScore: null,
                isPlayed: 0,
                hasRolled: function() {
                    if (
                        this.scores.attempts.first == null
                        && this.scores.attempts.second == null
                    ) {
                        return false;
                    }

                    return true;
                },
                scores: {
                    attempts: {
                        first: null,
                        second: null,
                        bonus: null,
                        1: {
                            score: function(p) {
                                var currFrame = game.getCurrentFrame();
                                currFrame.scores.attempts.first = p;
                                currFrame.currentAttempt++;
                                currFrame.updateAttemptsState();

                                var _id = currFrame.getHtmlFrameId();
                                var _htmlClass = '.first-attempt';
                                var toPaste = p;

                                if (currFrame.isStrike()) {
                                    toPaste = currFrame.symbolToPaste;
                                    _htmlClass = '.second-attempt';
                                    game.updateFrameScores();
                                    currFrame.markPlayed();
                                    game.activateNextFrame();
                                    game.updateRollsPane();
                                }

                                $(_id + ' ' + _htmlClass).html(toPaste);
                            }
                        },
                        2: {
                            score: function(p) {

                                var currFrame = game.getCurrentFrame();
                                currFrame.scores.attempts.second = p;
                                var toPaste = p;
                                if (currFrame.isSpare() || currFrame.isMiss()) {
                                    toPaste = currFrame.symbolToPaste;
                                }

                                var _id = currFrame.getHtmlFrameId();
                                $(_id + ' .second-attempt').html(toPaste);
                                game.updateFrameScores();

                                if (currFrame.hasBonus()) {
                                    game.updateRollsPane();
                                    return;
                                }

                                currFrame.markPlayed();

                                game.activateNextFrame();
                                game.updateRollsPane();
                            }
                        },
                        bonus: {
                            score: function(p) {
                                var currFrame = game.getCurrentFrame();
                                var attempts = currFrame.scores.attempts;
                                attempts.bonus = p;
                                var _id = currFrame.getHtmlFrameId();
                                $(_id + ' ' + ' .bonus-attempt').html(p);
                                game.updateFrameScores();
                            }
                        }
                    }
                },
                hasBonus: function() {
                    if (this.number < 10) {
                        return false;
                    }

                    var rollScore = this.getRolledPins(1) + this.getRolledPins(2);
                    if (rollScore >= 10) {
                        return true;
                    }

                    return false;
                },
                setFrameScore: function(score) {
                    this.frameScore = score;
                    this.pasteFrameTotal();
                },
                isCurrent: function() {
                    if (this.number == game.currentFrame) {
                        return true;
                    }
                    return false;
                },
                hasPrevFrame: function() {
                    var p = this.getPrevFrame();
                    if (typeof p != 'undefined') {
                        return true;
                    }
                    return false;
                },
                hasNextFrame: function() {
                    // remember kids ... it's essentially a Linked List :)
                    // hehehe now u know staying awake in Data Structures class pays off :P
                    var n = this.getNextFrame();
                    if (!n || typeof n == 'undefined') {
                        return false;
                    }
                    return true;
                },
                canCalculateStrike: function() {
                    /*
                     *  In order to calculate a Strike, we need the
                     *  score for the next two rolls.
                     */
                    if (!this.hasNextFrame()) {
                        return false;
                    }

                    var next1 = this.getNextFrame();
                    if (!next1.hasRolled()) {
                        return false;
                    }

                    if (next1.isStrike()) {
                        if (!next1.hasNextFrame()) {
                            return false;
                        }
                        if (!next1.getNextFrame().hasRolled()) {
                            return false;
                        }
                    } else if (this.hasPrevFrame()) {
                        var prevFrame = this.getPrevFrame();
                        if (!prevFrame.hasRolled()) {
                            return false;
                        }
                        if (prevFrame.frameScore == null) {
                            return false;
                        }
                    }

                    return true;
                },
                canCalculateSpare: function() {
                    if (!this.hasNextFrame()) {
                        return false;
                    }

                    var next = this.getNextFrame();
                    if (!next.hasRolled()) {
                        return false;
                    }

                    return true;
                },
                getRolledPins: function(attempt) {
                    if ([1,2,'bonus'].indexOf(attempt) < 0) {
                        return null;
                    }

                    var map = {
                        1: "first",
                        2: "second",
                        "bonus": "bonus"
                    };

                    var roll = map[attempt];

                    var pins = parseInt(this.scores.attempts[roll]);
                    if (isNaN(pins)) {
                        return 0;
                    }

                    return pins;
                },
                calculate: function() {

                    var me = this;

                    var strike = function() {
                        if (!me.canCalculateStrike()) {
                            return;
                        }

                        var bonus = 0;

                        var next1 = me.getNextFrame();

                        if (next1.isStrike()) {
                            bonus = 10;
                            var next2 = next1.getNextFrame();
                            if (next2.isStrike()) {
                                bonus += 10;
                            } else {
                                bonus += next2.getRolledPins(1);
                            }
                        } else {
                            bonus = next1.getRolledPins(1) + next1.getRolledPins(2);
                        }

                        var prevScore = me.getPrevScore();
                        var total = 10 + prevScore + bonus;

                        me.setFrameScore(total);
                    }

                    var spare = function() {
                        if (!me.canCalculateSpare()) {
                            return;
                        }

                        var score = 10;
                        var next = me.getNextFrame();
                        if (next.isStrike()) {
                            score += 10;
                        } else {
                            score += next.getRolledPins(1);
                        }

                        score += me.getPrevScore();
                        me.setFrameScore(score);
                    }

                    var miss = function() {
                        me.setFrameScore(me.getPrevScore());
                    }

                    var normal = function() {
                        if (me.frameScore != null) {
                            return;
                        }
                        var first = me.getRolledPins(1);
                        var second = me.getRolledPins(2);
                        var total = first + second;
                        var prev = 0;

                        if (me.hasPrevFrame()) {
                            me.getPrevFrame().calculate();
                        }

                        prev = me.getPrevScore();

                        var score = total + prev;
                        me.setFrameScore(score);
                    }

                    var bonus = function() {
                        alert('BONUS !!');
                        var total = me.getPrevScore()
                            + me.getRolledPins(1)
                            + me.getRolledPins(2)
                            + me.getRolledPins('bonus');

                        me.setFrameScore(total);
                    }

                    var _map = {
                        'isBonusShot': bonus,
                        'isStrike': strike,
                        'isSpare': spare,
                        'isMiss': miss,
                        'isNormal': normal
                    };

                    for (var type in _map) {
                        if (me[type]()) {
                            console.log('Map Type: ' + type);
                            _map[type]();
                        }
                    }
                },
                isBonusShot: function() {
                    if (
                        this.hasBonus()
                        && this.scores.attempts.second !== null
                    ) {
                        return true;
                    }

                    return false;
                },
                getHtmlFrameId: function() {
                    return '#frame-' + this.number;
                },
                init: function(n) {
                    this.number = n;
                    return this;
                },
                activate: function() {
                    $('#curr-frame').html(this.number);
                    $('#curr-frame-attempt').html(this.currentAttempt);

                    game.currentFrame = this.number;
                    $(this.getHtmlFrameId()).removeClass('tobeplayed').addClass('active-frame');

                    return this;
                },
                getScore: function() {
                    return this.frameScore;
                },
                getNextFrame: function() {
                    if (this.number > 9) {
                        return null;
                    }

                    return game.frames[this.number + 1];
                },
                getPrevFrame: function() {
                    return game.frames[this.number - 1];
                },
                getPrevScore: function() {
                    if (this.number == 1) { // score should be set to zero if it's the first frame
                        return 0;
                    }

                    var prevFrame = this.getPrevFrame();
                    if (typeof prevFrame == 'undefined') {
                        return 0;
                    }

                    var score = prevFrame.getScore();
                    if (!score) {
                        return 0;
                    }

                    return score;
                },
                score: function(p) { // p = number of pins

                    console.log('Frame # ' + this.number);
                    console.log('Current Attempt: ' + this.currentAttempt);

                    var attemptType = this.currentAttempt;
                    if (this.isBonusShot()) {
                        attemptType = 'bonus';
                    }

                    this.scores.attempts[attemptType].score(p);
                    console.log('Curr Attempt: ' + this.currentAttempt);
                },
                updateAttemptsState: function() {
                    $('#curr-frame-attempt').html(this.currentAttempt);
                },

                pasteFrameTotal: function() {
                    var score = parseInt(this.frameScore);
                    $(this.getHtmlFrameId() + ' .frame-total').html(score);
                },

                markPlayed: function() {
                    this.isPlayed = 1;
                    $(this.getHtmlFrameId()).removeClass('active-frame').addClass('played');
                },

                isStrike: function() {
                    var s = this.getRolledPins(1);

                    if (s == 10) {
                        this.symbolToPaste = '&times;';
                        return true;
                    }

                    return false;
                },
                isSpare: function() {
                    var f = this.getRolledPins(1);
                    var s = this.getRolledPins(2);

                    if (f == 10) {
                        return false; // this is a strike!
                    }

                    if ((f + s) == 10) {
                        this.symbolToPaste = '&sol;';
                        return true;
                    }

                    return false;
                },
                isMiss: function() {

                    if (!this.hasRolled()) {
                        return false;
                    }

                    var f = this.getRolledPins(1);
                    var s = this.getRolledPins(2);

                    if ((f == 0 && s == 0)) {
                        this.symbolToPaste = '&mdash;';
                        return true;
                    }

                    return false;
                },
                isNormal: function() {
                    var f = this.getRolledPins(1);
                    var s = this.getRolledPins(2);

                    if ((f + s) < 10) {
                        return true;
                    }

                    return false;
                },
                symbolToPaste: null
            };
        },
        updateRollsPane: function() {
            var cf = this.getCurrentFrame();
            var maxPins = 10;
            if (cf.currentAttempt > 1) {
                maxPins = 10 - cf.scores.attempts.first;
            }

            $('#rolls-pane').html('');

            for (var i=0; i < maxPins + 1; i++) {

                var lnk = $('<a />', {
                    'href': 'javascript:void(0)',
                    'class': 'btn btn-inverse scorebtn',
                    'html': i
                });

                lnk.css({
                    'margin-left': '5px',
                    'margin-right': '5px'
                });

                lnk.click(function() {
                    game.update($(this).html());
                });

                $('#rolls-pane').append(lnk);
            }
        },
        activateNextFrame: function() {
            if (this.getCurrentFrame().number > 9) {
                return;
            }

            game.frames[this.getCurrentFrame().number + 1].activate();
        },
        update: function(pins) {
            if (game.finished) {
                return;
            }
            game.getCurrentFrame().score(pins);
            game.updateRollsPane();
        }
    };


    $(function() {
        game.init();

        $('.scorebtn').click(function() {
            game.update($(this).html());
        });
    });
</script>

<h3>Frame: <span id="curr-frame">1</span> </h3>
<h4>Roll: <span id="curr-frame-attempt">1</span> </h4>

<hr>

<div id="scoreboard">

    <h4>Select the Number of Pins you knocked down</h4>
    <div class="row-fluid">
		<blockquote id="rolls-pane">
			<?php foreach ([0,1,2,3,4,5,6,7,8,9,10] as $num): ?>

				<?php echo $this->html->link($num, 'javascript:void(0);', [
					'class' => 'btn btn-inverse scorebtn'
				]); ?>

			<?php endforeach; ?>
        </blockquote>
    </div>

    <hr>

    <div class="row frames-container">
    <?php for ($i=1; $i < 11; $i++): ?>

        <?php

            $colspan = 2;
            if ($i >= 10) {
                $colspan = 3;
            }

		    $tableClass = 'frame tobeplayed';
        ?>

        <table class="<?php echo $tableClass; ?>" id="frame-<?php echo $i; ?>">
            <thead>
            <tr>
                <td colspan="<?php echo $colspan; ?>" class="frame-header"><?php echo $i; ?></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="first-attempt">&nbsp;</td>
                <td class="second-attempt">&nbsp;</td>
            <?php if ($i >= 10): ?>
                <td class="last-frame-attempt">&nbsp;</td>
            <?php endif; ?>
            </tr>
            <tr>
                <td colspan="<?php echo $colspan; ?>" class="frame-total">&nbsp;</td>
            </tr>
            </tbody>
        </table>

    <?php endfor; ?>

        <table class="frame scoretab">
            <thead>
            <tr>
                <td class="frame-header">Total:</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="score-body" id="grand-total">0</td>
            </tr>
            </tbody>
        </table>

    </div>

</div>


