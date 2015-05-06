/***************************************************************************
* Program:
*    Assignment 01, OOP Review
*    Brother Ercanbrack, CS 235
* Author:
*    Bryce Perry    
* Summary: 
*    This program helps us to make a Set of integers.
***************************************************************************/

#include <iostream>
#include <cstring>
#include <string>
#include <fstream>
#include <iomanip>

using namespace std; 

const int DEFAULT_SIZE_ARRAY = 100; 

/**************************************************************************
* Class Name: Set
* Summary: A Set is basically a list of integers. 
**************************************************************************/
class Set
{ 
   public: 
      Set();
      Set(int size);                   
      Set(const Set& obj);    // Copy Constructor
      ~Set();                 // Destructor
      void add(int elem);             
      int numOfElem() {return locInSet;}; 
      bool searchElem(int elem); 
      void readIn(int num[]);

      Set operator && (const Set& obj); 
      Set operator || (const Set& obj);
      Set operator - (const Set& obj);
      Set& operator = (const Set& obj);

      int getSizeofSet(); 
      void setSizeofSet(); 

      int getArraySize(); 
      void setArraySize(); 
    
      void display(); 
      void sort(); 

   private: 
      int* setList; // dyn alloc array of integers
      int locInSet;  // size of set
      int arraySize;  // capacity of the dyn allocated array 
}; 

/**************************************************************************
* Main controls the creation and output of Set objects. 
***************************************************************************/
int main(int argc, char* argv[]) 
{
   int numberInList;
   int i = 0; 
   int num[100]; 
   ifstream fin; 
   char* file; 

   if (argc > 1)
   {
      file = argv[1];  
   }
   else
   {
      cout << "Enter input filename: "; 
      file = new char[80]; 
      cin >> file; 
   }
   fin.open(file);
   while (fin.fail())
   { 
      cout << "File not found: " << endl; 
      cin >> file;          
      fin.open(file);
   }
   int arrayLengthA;
   fin >> arrayLengthA;
   Set listA(arrayLengthA); 
   int curInt; 
   for ( int i = 0; i < arrayLengthA; i++ )
   { 
      fin >> curInt;
      listA.add(curInt);  
   }
   cout << "Set A:\n";
   listA.sort();    
   listA.display(); 
   int arrayLengthB; 
   fin >> arrayLengthB; 
   Set listB(arrayLengthB); 
   for ( int i = 0; i < arrayLengthB; i++ )
   { 
      fin >> curInt;
      listB.add(curInt);  
   } 
   fin.close();
   cout << endl << endl << "Set B:\n";
   Set tmp; 
   tmp = listB; 
   tmp.sort(); 
   tmp.display();
   Set listC; 
   cout << "\nIntersection of A and B:\n";
   listC = listA && listB; 
   listC.sort(); 
   listC.display();  
   cout << endl;
   Set diffAB; 
   Set uni; 
   diffAB = listB - listA; 
   diffAB.sort();
   Set diffBA; 
   diffBA = listA - listB; 
   diffBA.sort(); 
   cout << "\nUnion of A and B:\n";
   uni = listA || listB; 
   uni.sort(); 
   uni.display();
   cout << endl << "\nDifference of A and B:\n";
   diffAB.display();
   cout << endl << "\nDifference of B and A:\n";
   diffBA.display(); 
   cout << endl << endl; 
   return 0; 
} 
/**************************************************************************
* Desc: Default Constructor.
**************************************************************************/
Set::Set()
{
   arraySize = DEFAULT_SIZE_ARRAY; 
   setList = new int[arraySize]; 
   locInSet = 0; 
}
/**************************************************************************
* Desc: Controls the size of an array constructor.
**************************************************************************/
Set::Set(int size)
{
   arraySize = size; 
   setList = new int[size]; 
   locInSet = 0; 
}

/**************************************************************************
* Desc: Copy Constructor 
**************************************************************************/
Set::Set(const Set& obj)
{   
   setList = new int[obj.arraySize];      // dyn alloc array of integers
   for (int i = 0; i < obj.arraySize; i++)
   { 
      setList[i] = obj.setList[i]; 
   }   
   locInSet = obj.locInSet;  // location in set of last number
   arraySize = obj.arraySize;  
}

/**************************************************************************
* Desc: Destructor 
**************************************************************************/
Set::~Set()
{
   delete [] setList; 
}

/***************************************************************************
* Desc: This function displays a Set.
***************************************************************************/
void Set::display()
{
   for ( int i = 0; i < locInSet; i++ )
   { 
      cout << setw(4) << setList[i]; 
      if ((i + 1) % 10 == 0)
         cout << '\n';
   } 
}

/**************************************************************************
* Desc: This function adds an integer to an element. 
***************************************************************************/
void Set::add(int elem)
{  
   if (!searchElem(elem))
   {
      setList[locInSet] = elem; 
      locInSet++; 
   }
   //sort(); 
} 

/***************************************************************************
* Desc: This function searches a set for a specific integer.
***************************************************************************/
bool Set::searchElem(int elem)
{
   bool temp = false; 
   for  (int i = 0; i < arraySize; i++)
   { 
      if (elem == setList[i])
      { 
         temp = true; 
      }
   }
   return temp; 
}

/***************************************************************************
* Desc: This function sorts a set. From low to high. 
***************************************************************************/
void Set::sort()
{
   for (int i = 0; i < locInSet; i++)
   {
      for (int j = 0; j < locInSet; j++)
      {
         if (setList[i] < setList[j])
         {
            int temp; 
            temp = setList[i];
            setList[i] = setList[j];
            setList[j] = temp; 
         }
      }
   }
}

/***************************************************************************
* Desc: This operator finds the intersection of two sets.
***************************************************************************/ 
Set Set::operator && (const Set& obj)
{
   Set temp(DEFAULT_SIZE_ARRAY); 
   int tempSize = arraySize; 
   if (arraySize < obj.arraySize)
      tempSize = obj.arraySize;

   for (int i = 0; i < obj.locInSet + 1; i++)
   { 
      if (searchElem(obj.setList[i])) 
         temp.add(obj.setList[i]); 
   }    
   return temp;    
}
   
/***************************************************************************
* Desc: This operator finds the union of two sets.
***************************************************************************/
Set Set::operator || (const Set& obj)
{
   Set temp(DEFAULT_SIZE_ARRAY); 
    
   int tempSize = arraySize; 
   if (arraySize < obj.arraySize)
      tempSize = obj.arraySize;

   for (int i = 0; i < obj.locInSet; i++)
   { 
      temp.add(obj.setList[i]); 
   } 
   for (int i = 0; i < locInSet; i++)
   { 
      temp.add(setList[i]); 
   }    
   
   return temp;  
}

/***************************************************************************
* Desc: This operator finds the difference between two sets.
***************************************************************************/
Set Set::operator - (const Set& obj)
{
   Set temp(DEFAULT_SIZE_ARRAY); 
   int tempSize = arraySize; 
   if (arraySize < obj.arraySize)
      tempSize = obj.arraySize;

   for (int i = 0; i < obj.locInSet + 1; i++)
   { 
      if (!searchElem(obj.setList[i])) 
         temp.add(obj.setList[i]); 
   }    
   return temp;  
}

/***************************************************************************
* Desc: This is the assignent operator.
***************************************************************************/
Set& Set::operator = (const Set& obj)
{
   setList = new int[obj.arraySize];      // dyn alloc array of integers
   for (int i = 0; i < obj.arraySize; i++)
   { 
      setList[i] = obj.setList[i]; 
   }   
   locInSet = obj.locInSet;  // location in set of last number
   arraySize = obj.arraySize;  // capa 
}
   

