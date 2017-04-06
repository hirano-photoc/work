#!/bin/sh
#
# git cloneした後に環境にシンボリック・リンクを貼るだけのシェルスクリプト
#

## ファイル一覧を配列に入れる
FILES=(".gitconfig")
FILES+=(".gitignore_global")
FILES+=(".tmux.conf")
FILES+=(".vimrc")
FILES+=(".zshrc")

PWD=`pwd`
echo $PWD

for FILE in ${FILES[@]}; do
    COMMAND="ln -s ${PWD}/${FILE} ${HOME}/"
    #echo "COMMAND "$COMMAND
    $COMMAND
done

echo "complete."

