TEX_FILES=tuto-git.tex \
          tuto-git-polycopie.tex
          
TEX_INCLUDES=contenu.tex \
	     introduction.tex \
             $(NULL)

PDF_FILES=$(TEX_FILES:%.tex=%.pdf)

all: $(PDF_FILES)

$(PDF_FILES): %.pdf: %.tex
	pdflatex $<
	pdflatex $<

$(TEX_FILES): $(TEX_INCLUDES)
	@touch $*.tex

clean:
	rm -f *.out *.nav *.toc *.aux *.log *.snm *.vrb *.dvi *.ps

.PHONY: all clean

