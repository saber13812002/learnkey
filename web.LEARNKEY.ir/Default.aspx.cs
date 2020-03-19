using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

public partial class _Default : System.Web.UI.Page
{


    WebApiApplication wa = new WebApiApplication();


    protected void Page_Load(object sender, EventArgs e)
    {

        //ContentPlaceHolder cFori = Page.Master.FindControl("itemsgridofferFori") as ContentPlaceHolder;
        //SetLiteralControl(cFori);

        ContentPlaceHolder c = Page.Master.FindControl("itemsgridoffer") as ContentPlaceHolder;
        SetLiteralControl(c);


    }

    private void SetLiteralControl(ContentPlaceHolder c)
    {
        if (c != null)
        {
            string storeprocedurename = "getallMelks";
            DataTable dt = wa.runstoreprocedure(storeprocedurename, "");

            if(dt.Rows.Count>0)
            //for (int i = dt.Rows.Count - 1; i > -1; i--)
            {


                LiteralControl l = new LiteralControl();

                string offer = "";
                int len = dt.Rows.Count;
                len = len - (len % 4);
                for (int ij = 0; ij < len; ij++)
                {
                    if ((ij + 4) % 4 == 0) 
                    {
                        l.Text += "<H3 class=\"train\">اکازیون</H3>" +
                            "<DIV class=\"railing\"></DIV></DIV>" +
                            "<DIV class=\"offers slide use-box-sizing-content-box\">";
                    }

                    offer += setoffer(ij, dt.Rows[ij]);


                    if (((ij + 1) % 4) == 0)
                    {

                        l.Text += string.Format("<UL class=\"items grid\" style=\"direction: rtl;\">{0}</UL>", offer);
                        l.Text += "</DIV>" +
                                "<DIV class=\"clearfix\"></DIV>" +
                                "<DIV class=\"train-railing separator m10\">" +
                                "<DIV class=\"railing\"></DIV>";
                        offer = "";

                    }
                }


                //l.Text="<script type=\"text/javascript\">$(document).ready(function () {js stuff;});</script>";
                c.Controls.Add(l);
            }

        }
    }

    private string setoffer(int i,DataRow dr)
    {
        return string.Format("<LI>" +
                           "<DIV class=\"offer\">" +
                           "<ADDRESS>" +
                           "<P>{0}</P></ADDRESS><A class=\"hover-image\" href=\"http://kolbeh.ir/{1}.html\"><SPAN" +
                           "class=\"roll link\"></SPAN><IMG height=\"163\" class=\"imgborder\" alt=\"کلیک کنید\" src=\"default_files/1(1).jpg\"></A>" +
                           "<UL class=\"prop-info\">" +
                           "<LI class=\"highlight\" style=\"text-align: center;\"><SPAN style=\"font-size: 16px; font-weight: 600;\">{2}</SPAN>" +
                           "</LI>" +
                           "<LI style=\"text-align: center;\"><SPAN style=\"color: black; font-size: 16px; font-weight: 600;\">{4},000,000" +
                           "تومان</SPAN>                            </LI>" +
                           "<LI><SPAN class=\"label\"> ثبت :</SPAN> <SPAN class=\"value\">{3}</SPAN>" +
                           "</LI>" +
                           "<LI><SPAN class=\"label\">بازدید :</SPAN> <SPAN class=\"value\"> {4}</SPAN>" +
                           "</LI>" +
                           "<LI><SPAN class=\"label\">عمر بنا :</SPAN> <SPAN class=\"value\"> {4}سال</SPAN>" +
                           "</LI>" +
                           "<LI class=\"last\"><A class=\"button th-brown view-details\" href=\"http://koomeh.ir/Home/Estate/8324\">مشاهده " +
                           "جزئیات</A></LI></UL></DIV></LI>", dr[1].ToString().Trim(), dr[2].ToString().Trim(), dr[3].ToString().Trim(), dr[4].ToString().Trim(), dr[6].ToString().Trim());
    }
}





/*



 <UL class="items grid" style="direction: rtl;">
  <LI>
  <DIV class="offer">
  <ADDRESS>
  <P>پردیسان</P></ADDRESS><A class="hover-image" href="http://koomeh.ir/Home/Estate/9651"><SPAN 
  class="roll link"></SPAN><IMG height="163" class="imgborder" alt="" src="default_files/default-estate.jpg"></A>




  <UL class="prop-info">
    <LI class="highlight" style="text-align: center;"><SPAN style="font-size: 16px; font-weight: 600;">آپارتمان 
    (رهن و اجاره)</SPAN>                                     </LI>
    <LI style="text-align: center;"><SPAN class="label">قیمت :</SPAN>            
                             <SPAN class="value">--</SPAN>                       
                 </LI>
    <LI><SPAN class="label">مساحت :</SPAN> <SPAN class="value">86 متر</SPAN>     
                                    </LI>
    <LI><SPAN class="label">تعداد اتاق :</SPAN> <SPAN class="value">2</SPAN>     
                                    </LI>
    <LI><SPAN class="label">عمر بنا :</SPAN> <SPAN class="value">--</SPAN>       
                                 </LI>
    <LI class="last"><A class="button th-brown view-details" href="http://koomeh.ir/Home/Estate/9651">مشاهده 
    جزئیات</A></LI></UL></DIV></LI>
  <LI>
  <DIV class="offer">
  <ADDRESS>
  <P>پردیسان</P></ADDRESS><A class="hover-image" href="http://koomeh.ir/Home/Estate/9640"><SPAN 
  class="roll link"></SPAN><IMG height="163" class="imgborder" alt="" src="default_files/default-estate.jpg"></A>
  <UL class="prop-info">
    <LI class="highlight" style="text-align: center;"><SPAN style="font-size: 16px; font-weight: 600;">آپارتمان 
    (رهن و اجاره)</SPAN>                                     </LI>
    <LI style="text-align: center;"><SPAN class="label">قیمت :</SPAN>            
                             <SPAN class="value">--</SPAN>                       
                 </LI>
    <LI><SPAN class="label">مساحت :</SPAN> <SPAN class="value">75 متر</SPAN>     
                                    </LI>
    <LI><SPAN class="label">تعداد اتاق :</SPAN> <SPAN class="value">2</SPAN>     
                                    </LI>
    <LI><SPAN class="label">عمر بنا :</SPAN> <SPAN class="value">--</SPAN>       
                                 </LI>
    <LI class="last"><A class="button th-brown view-details" href="http://koomeh.ir/Home/Estate/9640">مشاهده 
    جزئیات</A></LI></UL></DIV></LI>
  <LI>
  <DIV class="offer">
  <ADDRESS>
  <P>پردیسان</P></ADDRESS><A class="hover-image" href="http://koomeh.ir/Home/Estate/9606"><SPAN 
  class="roll link"></SPAN><IMG height="163" class="imgborder" alt="" src="default_files/default-estate.jpg"></A>
  <UL class="prop-info">
    <LI class="highlight" style="text-align: center;"><SPAN style="font-size: 16px; font-weight: 600;">آپارتمان 
    (رهن و اجاره)</SPAN>                                     </LI>
    <LI style="text-align: center;"><SPAN class="label">قیمت :</SPAN>            
                             <SPAN class="value">--</SPAN>                       
                 </LI>
    <LI><SPAN class="label">مساحت :</SPAN> <SPAN class="value">105 متر</SPAN>    
                                     </LI>
    <LI><SPAN class="label">تعداد اتاق :</SPAN> <SPAN class="value">2</SPAN>     
                                    </LI>
    <LI><SPAN class="label">عمر بنا :</SPAN> <SPAN class="value">--</SPAN>       
                                 </LI>
    <LI class="last"><A class="button th-brown view-details" href="http://koomeh.ir/Home/Estate/9606">مشاهده 
    جزئیات</A></LI></UL></DIV></LI>
  <LI>
  <DIV class="offer">
  <ADDRESS>
  <P>پردیسان</P></ADDRESS><A class="hover-image" href="http://koomeh.ir/Home/Estate/9604"><SPAN 
  class="roll link"></SPAN><IMG height="163" class="imgborder" alt="" src="default_files/default-estate.jpg"></A>
  <UL class="prop-info">
    <LI class="highlight" style="text-align: center;"><SPAN style="font-size: 16px; font-weight: 600;">آپارتمان 
    (رهن و اجاره)</SPAN>                                     </LI>
    <LI style="text-align: center;"><SPAN class="label">قیمت :</SPAN>            
                             <SPAN class="value">--</SPAN>                       
                 </LI>
    <LI><SPAN class="label">مساحت :</SPAN> <SPAN class="value">90 متر</SPAN>     
                                    </LI>
    <LI><SPAN class="label">تعداد اتاق :</SPAN> <SPAN class="value">2</SPAN>     
                                    </LI>
    <LI><SPAN class="label">عمر بنا :</SPAN> <SPAN class="value">--</SPAN>       
                                 </LI>
    <LI class="last"><A class="button th-brown view-details" href="http://koomeh.ir/Home/Estate/9604">مشاهده 
    جزئیات</A></LI></UL></DIV></LI>
  <LI>
  <DIV class="offer">
  <ADDRESS>
  <P>پردیسان</P></ADDRESS><A class="hover-image" href="http://koomeh.ir/Home/Estate/9603"><SPAN 
  class="roll link"></SPAN><IMG height="163" class="imgborder" alt="" src="default_files/default-estate.jpg"></A>
  <UL class="prop-info">
    <LI class="highlight" style="text-align: center;"><SPAN style="font-size: 16px; font-weight: 600;">آپارتمان 
    (رهن و اجاره)</SPAN>                                     </LI>
    <LI style="text-align: center;"><SPAN class="label">قیمت :</SPAN>            
                             <SPAN class="value">--</SPAN>                       
                 </LI>
    <LI><SPAN class="label">مساحت :</SPAN> <SPAN class="value">70 متر</SPAN>     
                                    </LI>
    <LI><SPAN class="label">تعداد اتاق :</SPAN> <SPAN class="value">1</SPAN>     
                                    </LI>
    <LI><SPAN class="label">عمر بنا :</SPAN> <SPAN class="value">--</SPAN>       
                                 </LI>
    <LI class="last"><A class="button th-brown view-details" href="http://koomeh.ir/Home/Estate/9603">مشاهده 
    جزئیات</A></LI></UL></DIV></LI>
  <LI>
  <DIV class="offer">
  <ADDRESS>
  <P>پردیسان</P></ADDRESS><A class="hover-image" href="http://koomeh.ir/Home/Estate/8752"><SPAN 
  class="roll link"></SPAN><IMG height="163" class="imgborder" alt="" src="default_files/default-estate.jpg"></A>
  <UL class="prop-info">
    <LI class="highlight" style="text-align: center;"><SPAN style="font-size: 16px; font-weight: 600;">آپارتمان 
    (رهن و اجاره)</SPAN>                                     </LI>
    <LI style="text-align: center;"><SPAN class="label">قیمت :</SPAN>            
                             <SPAN class="value">--</SPAN>                       
                 </LI>
    <LI><SPAN class="label">مساحت :</SPAN> <SPAN class="value">75 متر</SPAN>     
                                    </LI>
    <LI><SPAN class="label">تعداد اتاق :</SPAN> <SPAN class="value">2</SPAN>     
                                    </LI>
    <LI><SPAN class="label">عمر بنا :</SPAN> <SPAN class="value">--</SPAN>       
                                 </LI>
    <LI class="last"><A class="button th-brown view-details" href="http://koomeh.ir/Home/Estate/8752">مشاهده 
    جزئیات</A></LI></UL></DIV></LI>
  <LI>
  <DIV class="offer">
  <ADDRESS>
  <P>پردیسان</P></ADDRESS><A class="hover-image" href="http://koomeh.ir/Home/Estate/8693"><SPAN 
  class="roll link"></SPAN><IMG height="163" class="imgborder" alt="" src="default_files/default-estate.jpg"></A>
  <UL class="prop-info">
    <LI class="highlight" style="text-align: center;"><SPAN style="font-size: 16px; font-weight: 600;">آپارتمان 
    (خرید و فروش)</SPAN>                                     </LI>
    <LI style="text-align: center;"><SPAN style="color: black; font-size: 16px; font-weight: 600;">134,000,000 
    تومان</SPAN>                                    </LI>
    <LI><SPAN class="label">مساحت :</SPAN> <SPAN class="value">105 متر</SPAN>    
                                     </LI>
    <LI><SPAN class="label">تعداد اتاق :</SPAN> <SPAN class="value">2</SPAN>     
                                    </LI>
    <LI><SPAN class="label">عمر بنا :</SPAN> <SPAN class="value">4 سال</SPAN>    
                                    </LI>
    <LI class="last"><A class="button th-brown view-details" href="http://koomeh.ir/Home/Estate/8693">مشاهده 
    جزئیات</A></LI></UL></DIV></LI>
  <LI>
  <DIV class="offer">
  <ADDRESS>
  <P>پردیسان</P></ADDRESS><A class="hover-image" href="http://koomeh.ir/Home/Estate/8641"><SPAN 
  class="roll link"></SPAN><IMG height="163" class="imgborder" alt="" src="default_files/default-estate.jpg"></A>
  <UL class="prop-info">
    <LI class="highlight" style="text-align: center;"><SPAN style="font-size: 16px; font-weight: 600;">آپارتمان 
    (رهن و اجاره)</SPAN>                                     </LI>
    <LI style="text-align: center;"><SPAN class="label">قیمت :</SPAN>            
                             <SPAN class="value">--</SPAN>                       
                 </LI>
    <LI><SPAN class="label">مساحت :</SPAN> <SPAN class="value">90 متر</SPAN>     
                                    </LI>
    <LI><SPAN class="label">تعداد اتاق :</SPAN> <SPAN class="value">2</SPAN>     
                                    </LI>
    <LI><SPAN class="label">عمر بنا :</SPAN> <SPAN class="value">--</SPAN>       
                                 </LI>
    <LI class="last"><A class="button th-brown view-details" href="http://koomeh.ir/Home/Estate/8641">مشاهده 
    جزئیات</A></LI></UL></DIV></LI></UL>


*/