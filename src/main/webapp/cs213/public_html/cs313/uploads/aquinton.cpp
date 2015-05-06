/***********************************************************************
* Program:
*    Assignment 01, Operator Overloading 
*    Brother Ercanbrack, CS235
* Author:
*    Adam Quinton
* Summary: 
*    This program will overload the '&&', '||', '-', and '=' operators
* to compare two sets of numbers from one file.
*
*    Estimated:  6.0 hrs   
*    Actual:     8.0 hrs
*      
************************************************************************/

#include <iostream>
#include <fstream>
#include <string.h>
#include <iomanip>

using namespace std;

/********************************************************
 * Set class
 * Holds an array of numbers and their capacity and size. 
 ********************************************************/
class set
{
   public:
      set();//default
      set(int capacity);
      set(const set &copyFrom);//copy       
      ~set(){};//destructor
   
      int const getSpot()           {return this->spot;};
      int const getCap()            {return this->capacity;};
      int const *getNums()          {return this->nums;};
      int setCap(int    &rhs) {this->capacity = rhs;};
      int setSpot(int   &rhs) {this->spot = rhs;};
      int dumpNum(int   &rhs, int spt);
      int appendNum(int &rhs);
      void sort();   
      void removeDuplicates();
      void display();
   
      set operator && (set &rhs);//instersect
      set operator || (set &rhs);//union
      set operator  - (set &rhs);//difference
      set operator  = (const set &rhs);//assignment
   
   private:
      int *nums;//array of all numbers in set
      int spot;//current amount of numbers in set
      int capacity;//size of nums array
};

/**********************************************************************
 *  Default Set Constructor
 ***********************************************************************/
set::set()
{
   capacity = 50;
   nums = new int[capacity];
   spot = 0;
   
   for (int i = 0; i < capacity; i++)
      nums[i] = -1;
}

/**********************************************************************
 * Set Constructor with capacity setter 
 ***********************************************************************/
set::set(int capacity)
{
   nums = new int[capacity];
   spot = 0;
   
   for (int i = 0; i < capacity; i++)
      nums[i] = -1;
}

/**********************************************************************
 *  Copy Constructor
 ***********************************************************************/
set::set(const set &copyFrom)
{
   capacity = copyFrom.capacity;
   nums = new int[copyFrom.capacity];
   spot = copyFrom.spot;
   
   for (int i = 0; i < capacity; i++)
      nums[i] = copyFrom.nums[i];
}

/**********************************************************************
 *  Test Display
 ***********************************************************************/
void set::display()
{
   for (int i = 1; i < this->capacity + 1; i++)
   {
         cout << setw(4) << this->nums[i - 1];
         if (i % 10 == 0 && i != this->capacity)
            cout << endl;
   }
   cout << endl;
}

/**********************************************************************
 *  Dumps numbers at start of program into their set
 ***********************************************************************/
int set::dumpNum(int &rhs, int spt)
{
   this->nums[spt] = rhs;
}

/**********************************************************************
 *  Appends a number to the end of a set
 ***********************************************************************/
int set::appendNum(int &rhs)
{
   bool unique = true;//check if array already has the number
   for (int i = 0; i < this->capacity; i++)
      if (this->nums[i] == rhs)
      {
         unique = false;
      }

   if (unique)
   {
      this->nums[this->capacity] = rhs;
      this->capacity++;
   }
}

/**********************************************************************
 * Overloaded intersect operator
 * Puts the common numbers from two sets into one set.
 ***********************************************************************/
set set::operator && (set &rhs)
{
   set *amped = new set(0);
   
   for (int i = 1; i < this->capacity + 1; i++)
      for (int c = 1; c < rhs.capacity + 1; c++)
         if (this->nums[i - 1] == rhs.nums[c - 1])
            amped->appendNum(rhs.nums[c - 1]);
   *this = *amped;
   return *this;
}

/**********************************************************************
 * Overloaded union operator
 * Combines two sets into one
 ***********************************************************************/
set set::operator || (set &rhs)
{
   set orred(0);
   for (int c = 1; c < rhs.capacity + 1; c++)
      orred.appendNum(rhs.nums[c - 1]);
   for (int c = 1; c < this->capacity + 1; c++)
      orred.appendNum(this->nums[c - 1]);
   orred.sort();
   *this = orred;
   return *this;
}

/**********************************************************************
 * Overloaded difference operator
 ***********************************************************************/
set set::operator - (set &rhs)
{
   set subbed(0);
   for (int i = 1; i < this->capacity + 1; i++)
   {
      bool found = true;
      for (int c = 1; c < rhs.capacity + 1; c++)
      {
         if (this->nums[i - 1] == rhs.nums[c - 1])
            found = false;
      }
      if (found)
         subbed.appendNum(this->nums[i - 1]);
   }
   *this = subbed;
   return *this;
}

/**********************************************************************
 * Set sorter
 ***********************************************************************/
void set::sort()
{
   for (int i = 0; i < this->capacity - 1; i++)
   {
      int smallPos = i;
      int smallVal = this->nums[smallPos];
      for (int j = i + 1; j < this->capacity; j++)
      {
         if (smallVal > this->nums[j])
         {
            smallPos = j;
            smallVal = this->nums[smallPos];
         }
      }
      this->nums[smallPos] = this->nums[i];
      this->nums[i] = smallVal; 
   }
   //remove duplicates
   this->removeDuplicates();
   this->removeDuplicates();
}

/**********************************************************************
 * Set remove duplicate numbers
 ***********************************************************************/
void set::removeDuplicates()
{
   for (int i = 2; i < this->capacity + 1; i++)
   {
      if (this->nums[i - 1] == this->nums[i - 2])
      {
         this->capacity--;
         for (int c = i - 1; c < this->capacity + 1; c++)
            this->nums[c] = this->nums[c + 1]; 
      }
   }
}

/**********************************************************************
 *  Overloaded assignment operator
 ***********************************************************************/
set set::operator = (const set &rhs)
{
   if (this == &rhs)
      return *this;
   if (rhs.spot > this->capacity)
   {
      delete [] this->nums;
      this->nums = new int [rhs.spot];
      this->capacity = rhs.spot;
   }
   this->spot = rhs.spot;
    this->capacity = rhs.capacity;
   for (int i = 0; i < this->capacity; i++)
      this->nums[i] = rhs.nums[i];
   
   return *this;
}

/**********************************************************************
 * Checks for file.  Reads file and sends contents to two sets.
 * Also calls the sort function.
 ***********************************************************************/
int readFile(int argc, char **argv, set &a, set &b)
{
   int integer;
   //file opening  
   char fileName[256];
   if (argc < 2)
   {
      cout << "File Name? ";
      cin.getline(fileName, 256);
   }
   else
      strcpy(fileName, argv[1]);
   ifstream fin;
   fin.open(fileName);

   if (fin.fail())
   {
      cout << "ERROR: " << fileName << " does not exist\n";
      return 1;
   }

   fin >> integer;
   a.setCap(integer);

   for (int i = 0; i < a.getCap(); i++)
   {
      fin >> integer;
      a.dumpNum(integer, i);
   }
   //SORT HERE
   a.sort();
   
   fin >> integer;
   b.setCap(integer);

   for (int i = 0; i < b.getCap(); i++)
   {
      fin >> integer;
      b.dumpNum(integer, i);
   }
   b.sort();
}

/**********************************************************************
 * MAIN
 * The driver.
 ***********************************************************************/
int main(int argc, char **argv)
{
   set a;
   set b;

   readFile(argc, argv, a, b);
   cout << "Set A:\n";
   a.display();
   cout << "\nSet B:\n";
   b.display();
   cout << "\nIntersection of A and B:\n";//&&
   set ta;//temp
   ta = a;
   ta && b;
   ta.display();
   cout << "\nUnion of A and B:\n";//||
   ta = a;
   ta || b;
   ta.display();
   cout << "\nDifference of A and B:\n";//-
   ta = a;
   ta - b;
   ta.display();
   cout << "\nDifference of B and A:\n";//-
   ta = b;
   ta - a;
   ta.display();
   cout << endl;

   return 0;
}
