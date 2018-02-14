while True:
    user_input= input('text file name: ')

    if user_input.upper() == 'N':
        break
    else:

        if user_input[-4:] != '.txt':
            user_input += '.txt'
    
        while True:
            try:
                file = open(user_input,'r')
            except:
                user_input = input('text file name: ')
                if user_input[-4:] != '.txt':
                    user_input += '.txt'
            else:
                break
        
        content = file.readlines()
        header = content.pop(0)
        header = header.strip().split('\t')
        header = ', '.join(header)
        file.close()
        
        for i in range(len(content)):
            content[i] = content[i].strip().split('\t')
            print(content[i])

        interger = eval(input('Integer index?:'))
        if interger!=[]:
            for i in range(len(content)):
                for j in interger:
                    content[i][j]=int(content[i][j])
##            content[i][1] = int(content[i][1])
##            content[i][3] = int(content[i][3])
        print(header)
        table_name = input('table name: ')

        lines = 'INSERT INTO ' + table_name + '(' + header +' )VALUES \n'
        for data in content:
            line = str(data)
            x = len(line)
            if content[len(content)-1] == data:
                lines += '(' + line[1:x-1] +')\n'
            else:
                lines += '(' + line[1:x-1] +'),\n'
        lines+=';\n\n'
        print(lines)
        confirm =input('confirm?:')
        if confirm.upper() == 'Y':
            new_file = open('newfile.txt','a+')
            new_file.write(lines)
            new_file.close()
