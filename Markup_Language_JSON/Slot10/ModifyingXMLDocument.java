package Slot10;
import java.io.*;
import org.xml.sax.*;
import javax.xml.parsers.*;
import org.xml.sax.helpers.DefaultHandler;

public class ModifyingXMLDocument {
    static String displayText[] = new String[1000];
static int numberLines = 0;
static String indentation = "";
public static void main(String args[])
{
ModifyingXMLDocument obj = new ModifyingXMLDocument();
obj.childLoop(args[0]);
try {
FileWriter filewriter = new FileWriter("new.xml");
for(int loopIndex = 0; loopIndex < numberLines; loopIndex++){
filewriter.write(displayText[loopIndex].toCharArray());
filewriter.write('\n');
}
filewriter.close();
} catch (
Exception e) {
e.printStackTrace(System.err);
}
}
public void childLoop(String uri)
{
DefaultHandler handler = this;
SAXParserFactory factory = SAXParserFactory.newInstance();
try {
SAXParser saxParser = factory.newSAXParser();
saxParser.parse(new File(uri), handler);
} catch (Throwable t) {}
}
public void startDocument()
{
displayText[numberLines] = indentation;
displayText[numberLines] += "<?xml version=\"1.0\" encoding=\""+
"UTF-8" + "\"?>";
numberLines++;
}
public void processingInstruction(String target, String data)
{
displayText[numberLines] = indentation;
displayText[numberLines] += "<?";
displayText[numberLines] += target;
if (data != null && data.length() > 0) {
displayText[numberLines] += ' ';
displayText[numberLines] += data;
} displayText[numberLines] += "?>";
numberLines++;
}
public void startElement(String uri, String localName,
String qualifiedName, Attributes attributes)
{
displayText[numberLines] = indentation;
indentation += " ";
displayText[numberLines] += '<';
displayText[numberLines] += qualifiedName;
if (attributes != null) {
int numberAttributes = attributes.getLength();
for (int loopIndex = 0; loopIndex < numberAttributes;
loopIndex++){
displayText[numberLines] += ' ';
displayText[numberLines] +=
attributes.getQName(loopIndex);
displayText[numberLines] += "=\"";
displayText[numberLines] +=
attributes.getValue(loopIndex);
displayText[numberLines] += '"';
}
} displayText[numberLines] += '>';
numberLines++;
}
public void characters(char characters[], int start, int length)
{
String characterData = (new String(characters, start,
length)).trim();
if(characterData.indexOf("\n") < 0 && characterData.length() > 0)
{
displayText[numberLines] = indentation;
displayText[numberLines] += characterData;
numberLines++;
}
}
public void ignorableWhitespace(char characters[], int start, int
length)
{
//characters(characters, start, length);
}
public void endElement(String uri, String localName, String
qualifiedName)
{
indentation = indentation.substring(0, indentation.length() - 4)
;
displayText[numberLines] = indentation;
displayText[numberLines] += "</";
displayText[numberLines] += qualifiedName;
displayText[numberLines] += '>';
numberLines++;
if (qualifiedName.equals("lastName")) {
startElement("", "elected", "elected", null);
characters("2004".toCharArray(), 0, "2004".length());
endElement("", "elected", "elected");
}
}
public void warning(SAXParseException exception)
{
System.err.println("Warning: " +
exception.getMessage());
}
public void error(SAXParseException exception)
{
System.err.println("Error: " +
exception.getMessage());
}
public void fatalError(SAXParseException exception)
{
System.err.println("Fatal error: " +
exception.getMessage());
}
    
}
